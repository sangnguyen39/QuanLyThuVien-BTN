<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){ 
        return view("admin.index");
    }
}
