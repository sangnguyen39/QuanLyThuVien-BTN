<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    //
    function accountpanel()
    
{

$user = DB::table("members")->whereRaw("member_id=?",[Auth::user()->member_id])->first();
return view("user.account",compact("user"));
}

//



    function saveaccountinfo(Request $request)
{
    $request->validate([
        'username' => ['required', 'string', 'max:255'],
        'full_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'phone' => ['nullable', 'string'],
        'photo' => ['nullable','image'],
        'student_id' => ['nullable','string'],
        'class' => ['nullable','string'],
        'course_year' => ['nullable','string'],
        'phone' => ['nullable','string'],
    ]);

    $id = $request->input('member_id');

    $data["username"] = $request->input("username");
    $data["phone"] = $request->input("phone");
    $data["email"] = $request->input("email");
    $data["student_id"] = $request->input("student_id");
    $data["class"] = $request->input("class");
    $data["course_year"] = $request->input("course_year");

    if($request->hasFile("photo"))
    {
        $fileName = $id . '.' . $request->file('photo')->extension();        
        $request->file('photo')->storeAs('public/profile', $fileName);
        $data['photo'] = $fileName;
    }

    DB::table("members")->where("member_id",$id)->update($data);

    return redirect()->route('account')->with('status', 'Cập nhật thành công');


}

}
