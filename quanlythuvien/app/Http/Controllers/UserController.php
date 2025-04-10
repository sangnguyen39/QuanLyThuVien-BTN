<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\BorrowRecord;
use Illuminate\Support\Facades\Auth;
use App\Models\Borrow;
use Illuminate\Support\Carbon;
class UserController extends Controller
{
    //
    public function index()
    {
        
       // Lấy sách được đọc nhiều nhất (kết hợp book và book_statistics)
     
     $popularBooks = DB::table('book')
    ->join('book_statistics', 'book.book_id', '=', 'book_statistics.book_id')
    ->orderBy('book_statistics.borrow_count', 'desc')
    ->select('book.book_id', 'book.book_title', 'book.file_anh_bia', 'book.nha_xuat_ban', 'book_statistics.borrow_count') 
    ->limit(5)
    ->get();


        // Lấy sách mới thêm vào gần nhất (chỉ từ bảng book)
        $newlyAddedBooks = DB::table('book')
    ->orderBy('created_at', 'desc')
    ->select('book.book_id', 'book.book_title', 'book.file_anh_bia', 'book.nha_xuat_ban') 
    ->limit(5)
    ->get();

    // thể loại
    $categories = DB::table('category')->get();


     // Lấy người đọc gần đây
    
     $recentBorrowers = DB::table('users')
                    ->join('borrow', 'users.member_id', '=', 'borrow.member_id')
                    ->select('users.member_id', 'users.name', 'users.photo', DB::raw('MAX(borrow.borrow_date) as latest_borrow_date')) // Lấy ngày mượn lớn nhất
                    ->groupBy('users.member_id', 'users.name', 'users.photo') // Nhóm theo người dùng
                    ->orderBy('latest_borrow_date', 'desc')
                    ->limit(5)
                    ->get();
                    

return view('user.index', compact('popularBooks', 'newlyAddedBooks', 'categories', 'recentBorrowers'));


    }

  

public function tatCaSach()
{
    $books = Book::all();
    $categories = DB::table('category')->get();
    $recentBorrowers = DB::table('users')
        ->join('borrow', 'users.member_id', '=', 'borrow.member_id')
        ->select('users.member_id', 'users.name', 'users.photo', DB::raw('MAX(borrow.borrow_date) as latest_borrow_date'))
        ->groupBy('users.member_id', 'users.name', 'users.photo')
        ->orderBy('latest_borrow_date', 'desc')
        ->limit(5)
        ->get();
        


    return view('user.tatca_sach', compact('books', 'categories', 'recentBorrowers'));
}

// tìm kiếm 
public function search(Request $request)
{
    $searchTerm = $request->input('search');
    


    $books = DB::table('book')
        ->where('book_title', 'like', '%' . $searchTerm . '%')
        ->orWhere('author', 'like', '%' . $searchTerm . '%')
        ->orWhere('nha_xuat_ban', 'like', '%' . $searchTerm . '%')
        ->orWhere(function ($query) use ($searchTerm) {
            $query->whereIn('category_id', function ($subQuery) use ($searchTerm) {
                $subQuery->select('category_id')
                    ->from('category')
                    ->where('category_name', 'like', '%' . $searchTerm . '%');
            });
        })
        ->get();
        // Lấy danh sách thể loại cho sidebar
        $categories = DB::table('category')->get();
    
        // Lấy người đọc gần đây cho sidebar 
        $recentBorrowers = DB::table('users')
            ->join('borrow', 'users.member_id', '=', 'borrow.member_id')
            ->select('users.member_id', 'users.name', 'users.photo', DB::raw('MAX(borrow.borrow_date) as latest_borrow_date'))
            ->groupBy('users.member_id', 'users.name', 'users.photo')
            ->orderBy('latest_borrow_date', 'desc')
            ->limit(5)
            ->get();
    
    
    

    return view('user.search_results', compact('books', 'searchTerm', 'categories', 'recentBorrowers'));
}
    















    //chi tiết 
    public function bookDetails($id)
{
    $book = DB::table('book')->where('book_id', $id)->first();

    if (!$book) {
        abort(404);
    }

    $categories = DB::table('category')->get();

    $recentBorrowers = DB::table('users')
        ->join('borrow', 'users.member_id', '=', 'borrow.member_id')
        ->select('users.member_id', 'users.name', 'users.photo', DB::raw('MAX(borrow.borrow_date) as latest_borrow_date'))
        ->groupBy('users.member_id', 'users.name', 'users.photo')
        ->orderBy('latest_borrow_date', 'desc')
        ->limit(5)
        ->get();

    $popularBooks = DB::table('book')
        ->join('book_statistics', 'book.book_id', '=', 'book_statistics.book_id')
        ->orderBy('book_statistics.borrow_count', 'desc')
        ->select('book.book_id', 'book.book_title', 'book.file_anh_bia', 'book.nha_xuat_ban', 'book_statistics.borrow_count')
        ->limit(5)
        ->get();

    return view('user.book_details', compact('book', 'popularBooks', 'categories', 'recentBorrowers'));
}
public function borrowBook(Request $request, $book_id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1|max:4',
    ]);

    try {
        $book = Book::findOrFail($book_id);

        if ($book->available_quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Không đủ sách để mượn. Chỉ còn ' . $book->available_quantity . ' quyển.');
        }

        // Tạo bản ghi trong bảng borrow
        $borrow = new Borrow();
        $borrow->member_id = Auth::id(); // member_id là người dùng
        $borrow->borrow_date = now();
        $borrow->due_date = now()->addDays(30); // hạn trả sau 30 ngày
        $borrow->status_book = 'borrowed';
        $borrow->save();

        // Tạo bản ghi chi tiết mượn trong bảng borrow_details
        /*$borrowDetail = new BorrowDetail();
        $borrowDetail->borrow_id = $borrow->borrow_id;
        $borrowDetail->book_id = $book_id;
        $borrowDetail->quantity = $request->quantity;
        $borrowDetail->save();*/

        // Cập nhật số lượng sách
        $book->available_quantity -= $request->quantity;
        $book->save();

        return redirect()->back()->with('success', 'Mượn sách thành công! Bạn vui lòng đến thư viện để nhận sách trong vòng 48 giờ.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
    }
}

/**
 * Display the borrowing history for the authenticated user
 */
public function borrowHistory()
{
    // Lấy ID của người dùng đã xác thực
    $userId = auth()->id();
    
    // Thêm borrow_id vào select
    $borrowHistory = DB::table('borrow')
        ->join('book', 'borrow.borrow_id', '=', 'book.book_id')
        ->select(
            'borrow.borrow_id', // Thêm dòng này
            'book.book_title as tieu_de',
            'borrow.borrow_date as ngay_muon',
            'borrow.due_date as han_tra',
            'borrow.return_date as ngay_tra',
            'borrow.status_book as trang_thai'
        )
        ->where('borrow.member_id', $userId)
        ->orderBy('borrow.borrow_date', 'desc')
        ->get();
    
    // Kiểm tra quy tắc không mượn quá 30 ngày
    foreach ($borrowHistory as $item) {
        // Tính số ngày đã mượn cho các sách chưa trả
        if ($item->trang_thai == 'borrowed' || $item->trang_thai == 'overdue') {
            $borrowDate = Carbon::parse($item->ngay_muon);
            $today = Carbon::now();
            $daysElapsed = $borrowDate->diffInDays($today);
            
            // Nếu đã mượn quá 30 ngày, cập nhật trạng thái thành quá hạn
            if ($daysElapsed > 30) {
                DB::table('borrow')
                    ->where('borrow_id', $item->borrow_id)
                    ->update(['status_book' => 'overdue']);
                
                $item->trang_thai = 'overdue';
            }
        }
    }
    
    return view('user.borrowedhistory', ['data' => $borrowHistory]);
}
}