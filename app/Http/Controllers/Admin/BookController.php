<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function getMonthlyLoans()
    {
        try {
            $monthlyLoans = DB::table('borrow')
                ->select(
                    DB::raw('MONTH(borrow_date) as month'),
                    DB::raw('YEAR(borrow_date) as year'),
                    DB::raw('COUNT(*) as total_loans')
                )
                ->groupBy(DB::raw('YEAR(borrow_date)'), DB::raw('MONTH(borrow_date)'))
                ->orderBy(DB::raw('YEAR(borrow_date)'), 'asc')
                ->orderBy(DB::raw('MONTH(borrow_date)'), 'asc')
                ->get();

            return response()->json($monthlyLoans);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch data',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function qlysach()
    {
        $books = DB::table('book')
            ->join('category', 'book.category_id', '=', 'category.category_id')
            ->select(
                'book.book_id as STT',
                'book.book_title as Tên_sách',
                'book.author as Tác_giả',
                'category.category_name as Thể_loại',
                'book.nha_xuat_ban as Nhà_xuất_bản',
                'book.publication_year as Năm_xuất_bản',
                'book.total_quantity as Số_lượng_tổng',
                'book.available_quantity as Số_lượng_hiện_có'
            )
            ->paginate(10);

        $the_loai = DB::table('category')
            ->select('category_id as Id_thể_loại', 'category_name as Tên_thể_loại')
            ->get();

        return view('admin.qlysach', compact('books', 'the_loai'));
    }

    public function showByCategory($id)
    {
        $books = DB::table('book')
            ->join('category', 'book.category_id', '=', 'category.category_id')
            ->select(
                'book.book_id as STT',
                'book.book_title as Tên_sách',
                'book.author as Tác_giả',
                'category.category_name as Thể_loại',
                'book.nha_xuat_ban as Nhà_xuất_bản',
                'book.publication_year as Năm_xuất_bản',
                'book.total_quantity as Số_lượng_tổng',
                'book.available_quantity as Số_lượng_hiện_có'
            )
            ->where('book.category_id', $id)
            ->paginate(10);

        $the_loai = DB::table('category')
            ->select('category_id as Id_thể_loại', 'category_name as Tên_thể_loại')
            ->get();

        return view('admin.qlysach', compact('books', 'the_loai', 'id'));
    }

    public function index()
    {
        $books = DB::table('book')
            ->join('category', 'book.category_id', '=', 'category.category_id')
            ->select(
                'book.book_id as STT',
                'book.book_title as Tên_sách',
                'book.author as Tác_giả',
                'category.category_name as Thể_loại',
                'book.nha_xuat_ban as Nhà_xuất_bản',
                'book.publication_year as Năm_xuất_bản',
                'book.total_quantity as Số_lượng_tổng',
                'book.available_quantity as Số_lượng_hiện_có'
            )
            ->paginate(10);

        $the_loai = DB::table('category')
            ->select('category_id as Id_thể_loại', 'category_name as Tên_thể_loại')
            ->get();

        return view('admin.bookcontroller', compact('books', 'the_loai'));
    }

    public function filterByCategory(Request $request)
    {
        $category = $request->input('category');
        $search = $request->input('search');

        $books = DB::table('book')
            ->join('category', 'book.category_id', '=', 'category.category_id')
            ->select(
                'book.book_id as STT',
                'book.book_title as Tên_sách',
                'book.author as Tác_giả',
                'category.category_name as Thể_loại',
                'book.nha_xuat_ban as Nhà_xuất_bản',
                'book.publication_year as Năm_xuất_bản',
                'book.total_quantity as Số_lượng_tổng',
                'book.available_quantity as Số_lượng_hiện_có'
            )
            ->when($category, function ($query) use ($category) {
                return $query->where('book.category_id', $category);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where('book.book_title', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json($books);
        }

        $the_loai = DB::table('category')
            ->select('category_id as Id_thể_loại', 'category_name as Tên_thể_loại')
            ->get();

        return view('admin.qlysach', compact('books', 'the_loai'));
    }

    public function edit($book_id)
    {
        $book = Book::findOrFail($book_id);
        $categories = DB::table('category')->get();
        return view('admin.edit', compact('book', 'categories'));
    }

    public function create()
    {
        $categories = DB::table('category')->get();
        return view('admin.add', compact('categories'));
    }

    public function update(Request $request, $book_id)
    {
        $validator = Validator::make($request->all(), [
            'book_title' => 'required',
            'category_id' => 'required',
            'author' => 'required',
            'publication_year' => 'required|integer|min:1900|max:' . date('Y'),
            'nha_xuat_ban' => 'required',
            'total_quantity' => 'required|integer|min:1',
            'file_anh_bia' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'mo_ta' => 'required|string|min:10|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $book = Book::findOrFail($book_id);
        $data = $request->except('file_anh_bia');

        if ($request->hasFile('file_anh_bia')) {
            // Delete old image if exists
            if ($book->file_anh_bia) {
                Storage::disk('public')->delete($book->file_anh_bia);
            }
            $data['file_anh_bia'] = $request->file('file_anh_bia')->store('book_covers', 'public');
        }

        $book->update($data);

        return redirect()->route('admin.qlysach')
            ->with('success', 'Cập nhật sách thành công!');
    }

    public function destroy($book_id)
    {
        try {
            $book = Book::findOrFail($book_id);
            
            // Delete book cover image if exists
            if ($book->file_anh_bia) {
                Storage::disk('public')->delete($book->file_anh_bia);
            }
            
            $book->delete();
            
            return redirect()->route('admin.qlysach')
                ->with('success', 'Xóa sách thành công!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Lỗi khi xóa sách: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_title' => 'required',
            'category_id' => 'required',
            'author' => 'required',
            'publication_year' => 'required|integer|min:1900|max:' . date('Y'),
            'nha_xuat_ban' => 'required',
            'total_quantity' => 'required|integer|min:1',
            'file_anh_bia' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'mo_ta' => 'required|string|min:10|max:500',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        // Xử lý việc tải lên file hình ảnh
        if ($request->hasFile('file_anh_bia')) {
            $imagePath = $request->file('file_anh_bia')->store('book_covers', 'public');
        }
    
        // Tạo sách mới
        $book = Book::create([
            'book_title' => $request->book_title,
            'category_id' => $request->category_id,
            'author' => $request->author,
            'publication_year' => $request->publication_year,
            'nha_xuat_ban' => $request->nha_xuat_ban,
            'total_quantity' => $request->total_quantity,
            'available_quantity' => $request->total_quantity,
            'file_anh_bia' => $imagePath ?? null,
            'mo_ta' => $request->mo_ta,
        ]);
    
        return redirect()->route('admin.qlysach')
            ->with('success', 'Thêm sách thành công!');
    }
}
