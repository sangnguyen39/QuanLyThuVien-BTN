<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword;


class Ticket extends Authenticatable implements AuthenticatableContract, CanResetPassword
{
    use HasFactory, Notifiable;

    protected $table = 'borrow';

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');

    }
    protected $fillable = [
        'borrow_id',
        'member_id',
        'borrow_date',
        'due_date',
        'return_date',
        'status_book',
    ];

    
}