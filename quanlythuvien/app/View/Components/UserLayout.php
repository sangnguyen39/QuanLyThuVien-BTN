<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;


class UserLayout extends Component
{
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $categories;
    public $recentBorrowers;

    public function __construct($categories, $recentBorrowers)
    {
        $this->categories = $categories;
        $this->recentBorrowers = $recentBorrowers;
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
