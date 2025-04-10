<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowRecord extends Model
{
    use HasFactory;
    
    protected $table = 'borrow_records'; // Chỉ định tên bảng
    
    protected $fillable = [
        'user_id',
        'book_id',
        'quantity',
        'borrow_date',
        'return_date',
        'status'
    ];
}
