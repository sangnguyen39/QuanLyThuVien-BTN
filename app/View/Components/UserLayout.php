<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\ThuVien;

class UserLayout extends Component
{
    public $categories;
    public $recentBorrowers;
    public $danhSachThuVien;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categories, $recentBorrowers)
    {
        $this->categories = $categories;
        $this->recentBorrowers = $recentBorrowers;
        $this->danhSachThuVien = ThuVien::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-layout');
    }
}
