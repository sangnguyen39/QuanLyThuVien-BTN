<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Book;


class UsersController extends Controller
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
    
     $recentBorrowers = DB::table('members')
                    ->join('borrow', 'members.member_id', '=', 'borrow.member_id')
                    ->select('members.member_id', 'members.username', 'members.photo', DB::raw('MAX(borrow.borrow_date) as latest_borrow_date')) // Lấy ngày mượn lớn nhất
                    ->groupBy('members.member_id', 'members.username', 'members.photo') // Nhóm theo người dùng
                    ->orderBy('latest_borrow_date', 'desc')
                    ->limit(5)
                    ->get();

                    $danhSachThuVien = DB::table('web_thuvien')->get(); 

          
                    

return view('user.index', compact('popularBooks', 'newlyAddedBooks', 'categories', 'recentBorrowers','danhSachThuVien'));


    }

  

public function tatCaSach()
{
    $books = Book::all();
    $categories = DB::table('category')->get();
    $recentBorrowers = DB::table('members')
        ->join('borrow', 'members.member_id', '=', 'borrow.member_id')
        ->select('members.member_id', 'members.username', 'members.photo', DB::raw('MAX(borrow.borrow_date) as latest_borrow_date'))
        ->groupBy('members.member_id', 'members.username', 'members.photo')
        ->orderBy('latest_borrow_date', 'desc')
        ->limit(5)
        ->get();

        $danhSachThuVien = DB::table('web_thuvien')->get(); // Thêm dòng này

        


    return view('user.tatca_sach', compact('books', 'categories', 'recentBorrowers','danhSachThuVien'));
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
        $recentBorrowers = DB::table('members')
            ->join('borrow', 'members.member_id', '=', 'borrow.member_id')
            ->select('members.member_id', 'members.username', 'members.photo', DB::raw('MAX(borrow.borrow_date) as latest_borrow_date'))
            ->groupBy('members.member_id', 'members.username', 'members.photo')
            ->orderBy('latest_borrow_date', 'desc')
            ->limit(5)
            ->get();
    
            $danhSachThuVien = DB::table('web_thuvien')->get(); // Thêm dòng này

    

    return view('user.search_results', compact('books', 'searchTerm', 'categories', 'recentBorrowers','danhSachThuVien'));
}
    


    //chi tiết 
    public function bookDetails($id)
{
    $book = DB::table('book')->where('book_id', $id)->first();

    if (!$book) {
        abort(404);
    }

    $categories = DB::table('category')->get();

    $recentBorrowers = DB::table('members')
    ->join('borrow', 'members.member_id', '=', 'borrow.member_id')
    ->select('members.member_id', 'members.username', 'members.photo', DB::raw('MAX(borrow.borrow_date) as latest_borrow_date'))
    ->groupBy('members.member_id', 'members.username', 'members.photo')
    ->orderBy('latest_borrow_date', 'desc')
    ->limit(5)
    ->get();

    $popularBooks = DB::table('book')
        ->join('book_statistics', 'book.book_id', '=', 'book_statistics.book_id')
        ->orderBy('book_statistics.borrow_count', 'desc')
        ->select('book.book_id', 'book.book_title', 'book.file_anh_bia', 'book.nha_xuat_ban', 'book_statistics.borrow_count')
        ->limit(5)
        ->get();

        $danhSachThuVien = DB::table('web_thuvien')->get(); // Thêm dòng này


    return view('user.book_details', compact('book', 'popularBooks', 'categories', 'recentBorrowers','danhSachThuVien'));
}




    
 
}

