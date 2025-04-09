<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login()
    {
        // Logic cho việc đăng nhập (nếu cần)
        return view('front-end.login'); // Chuyển hướng đến view đăng nhập
    }

    public function register()
    {
        return view('front-end.register'); // Chuyển hướng đến view đăng ký
    }

    public function postRegister(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Tạo người dùng mới
        // User::create([
        //     'name' => $validatedData['name'],
        //     'email' => $validatedData['email'],
        //     'password' => bcrypt($validatedData['password']),
        // ]);

        // Chuyển hướng hoặc trả về phản hồi
        return redirect()->route('login')->with('success', 'Đăng ký thành công!');
    }
}