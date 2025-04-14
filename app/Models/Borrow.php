<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $table = 'borrow';


    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Mối quan hệ với model Member
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // Mối quan hệ với bảng borrowDetails
    public function borrowDetails()
    {
        return $this->hasMany(BorrowDetail::class);
    }
    
    
}
