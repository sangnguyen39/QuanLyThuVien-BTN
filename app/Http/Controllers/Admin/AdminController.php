<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function logon(){ 
        return view('admin.logon');
    }
    public function postLogon(Request $request){
        if(auth::attempt(['email'=> $request->email,'password'=> $request->password, 'role' =>  'admin'])) {
            return redirect()->route('admin.index');
    }
    return redirect('/logon')->with('error', 'Sai thông tin');
}
}
