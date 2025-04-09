<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword;


class Member extends Authenticatable implements AuthenticatableContract, CanResetPassword
{
    use HasFactory, Notifiable;

    protected $table = 'members';
    protected $primaryKey = 'member_id'; 

    protected $fillable = [
        'student_id',
        'full_name',
        'email',
        'class',
        'course_year',
        'username',
        'password', // Lưu ý: Chúng ta sẽ hash password trước khi lưu
        'role',
    ];

    // Nếu bạn muốn ẩn trường password khi chuyển đổi model thành JSON
    protected $hidden = [
        'password',
    ];
}