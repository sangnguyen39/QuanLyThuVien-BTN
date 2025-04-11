<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Book; 

class theloaiController extends Controller
{
    public function theloai(Request $request, $id)
    {
        $books = Book::where('category_id', $id)->get();
    
        $category = DB::table('category')->where('category_id', $id)->first();
    
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

    
        return view('user.theloai', compact('books', 'category', 'categories', 'recentBorrowers','danhSachThuVien'));
    }
    


}