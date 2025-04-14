<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\ThuVien; // ✅ Đã thêm dòng này

class UserLayout extends Component
{
    public $categories;
    public $recentBorrowers;
    public $danhSachThuVien;

    public function __construct($categories, $recentBorrowers)
    {
        $this->categories = $categories;
        $this->recentBorrowers = $recentBorrowers;
        $this->danhSachThuVien = ThuVien::all(); // 🟢 Không còn lỗi
    }

    public function render()
    {
        return view('components.user-layout');
    }
}
