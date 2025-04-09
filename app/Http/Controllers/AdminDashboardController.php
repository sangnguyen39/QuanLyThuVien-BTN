<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Log::info('AdminDashboardController executed');
        try {
            // Truy vấn dữ liệu cho biểu đồ
            $categories = DB::table('book')->select('book_title', DB::raw('COUNT(*) as borrow_count'))
                ->groupBy('book_title')->get();
        } catch (\Exception $e) {
            $categories = collect([]);
        }

        try {
            // Thống kê sách
            $totalBooks = DB::table('book')->sum('total_quantity') ?? 0; 
            $borrowedCount = DB::table('borrow')->where('status_book', 'borrowed')->count() ?? 0;
            $returnedCount = DB::table('borrow')->where('status_book', 'returned')->count() ?? 0;
            $overdueCount = DB::table('borrow')->where('status_book', 'overdue')->count() ?? 0;
        } catch (\Exception $e) {
            $totalBooks = $borrowedCount = $returnedCount = $overdueCount = 0;
        }

        try {
            // Danh sách sinh viên quá hạn
            $overdueMembers = DB::table('members')->where('status', 'overdue')->limit(10)->get();
        } catch (\Exception $e) {
            $overdueMembers = collect([]);
        }

        return view('admin.index', compact('categories', 'totalBooks', 'borrowedCount', 'returnedCount', 'overdueCount', 'overdueMembers'));
    }
}