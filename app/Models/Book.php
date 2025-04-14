<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'book';
    
    protected $primaryKey = 'book_id';
    
    protected $fillable = [
        'book_title',
        'category_id',
        'author',
        'publication_year',
        'nha_xuat_ban',
        'total_quantity',
        'available_quantity',
        'file_anh_bia',
        'mo_ta'
    ];
}
