<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = DB::table('category')->get();
        $popularBooks = DB::table('book')
                        ->orderBy('available_quantity', 'desc')
                        ->limit(10)
                        ->get();

        return view("admin.index", [
            'categories' => $categories,
            'popularBooks' => $popularBooks
        ]);
    }
}
