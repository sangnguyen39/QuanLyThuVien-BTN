<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Member;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    
    public function showlogin()
    {
        // Logic cho việc đăng nhập (nếu cần)
        return view('auth.login'); // Chuyển hướng đến view đăng nhập
    }
    public function login(Request $request){ 
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password'=> 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                }
                $remember = $request->has('remember');
                // if(Auth::attempt(['username' => $request->username,'password' => $request->password],$remember)){
                //     if(auth::user()->role=='admin'){
                //         return redirect()->route('admin.index');
                //     }
                //     if(auth::user()->role=='student'){
                //         return redirect()->route('user.index');
                //     }
                // }
                if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $remember)) {
                    $user = Auth::user();
                    if ($user->role === 'admin') {
                        return redirect()->route('admin.index'); 
                    } elseif ($user->role === 'student') {
                        return redirect('/'); //
                    }
                }
                if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $remember)) {
    $user = Auth::user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.index'); 
    } elseif ($user->role === 'student') {
        return redirect('/'); // về trang chủ dành cho học sinh
    }
}

                
                
                return redirect()->back()->with('error', 'Invalid credentials');
                
    }


    public function showregister()
    {
        return view('auth.register'); // Chuyển hướng đến view đăng ký
    }

    public function store(Request $request)
    {
      //dd($request->all());  
      if($request->isMethod('post')){ 
        $validator = validator::make($request->all(),[
            'student_id'=>'required',
            'full_name' => 'required',
            'email'=> 'required|email',
            'class'=> 'required',
            'course_year' => 'required',
            'username' => 'required|min:6|max:30|alpha',
            'password'=> 'required|min:6|max:20',
        ]);
        if($validator->fails()){ 
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $member = Member::where('student_id', $request->student_id)->first();
        if(!$member){ 
            $member = Member::create([
                'student_id' => $request->student_id,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'class' => $request->class,
                'course_year' => $request->course_year,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role' => 'student'
            ]);
            if ($member) {
                return redirect()->route('auth.showlogin')->with('message', 'Bạn đã đăng ký thành công, vui lòng đăng nhập');
            } else {
                return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
            } }
      }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
