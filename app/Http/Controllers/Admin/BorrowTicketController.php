<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Member;

class BorrowTicketController extends Controller
{
    //
    public function destroy($member_id)
    {
        $member = Member::where('member_id', $member_id)->firstOrFail();
        $member->delete();
    
        return redirect()->route('admin.qlmember')->with('success', 'Xóa thành công!');
    }

    public function mainlayout()
    {

        return view('layouts.borrow-management');
    }

    
    public function borrowList(Request $request)
    {
        $status = $request->input('status', 'all');
        $keyword = $request->input('keyword');
    
        $query = Ticket::with('member');
    
        if ($status !== 'all') {
            $query->where('status_book', $status);
        }
    
        // Lọc theo mã sinh viên
        if ($keyword) {
            $query->whereHas('member', function ($q) use ($keyword) {
                $q->where('student_id', 'like', '%' . $keyword . '%');
            });
        }
    
        $data = $query->paginate(10);
    
        return view('admin.qlphieumuon', compact('data', 'status'));
    }

    public function members(Request $request)
    {
        $status = $request->input('status', 'all');
        $keyword = $request->input('keyword');
    
        // Dùng query builder
        $query = Member::query();
    
        // Lọc theo status nếu có
        if ($status !== 'all') {
            $query->where('status_book', $status);
        }
    
        // Lọc theo mã sinh viên
        if ($keyword) {
            $query->where('student_id', 'like', '%' . $keyword . '%');
        }
    
        // Phân trang
        $data = $query->paginate(10);
    
        return view('admin.qlmember', compact('data'));
    }
    
}
