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
        $recentBorrowers = DB::table('users')
            ->join('borrow', 'users.member_id', '=', 'borrow.member_id')
            ->select('users.member_id', 'users.name', 'users.photo', DB::raw('MAX(borrow.borrow_date) as latest_borrow_date'))
            ->groupBy('users.member_id', 'users.name', 'users.photo')
            ->orderBy('latest_borrow_date', 'desc')
            ->limit(5)
            ->get();
    
        return view('user.theloai', compact('books', 'category', 'categories', 'recentBorrowers'));
    }
    


}