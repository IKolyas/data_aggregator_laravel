<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActualUser extends Model
{
    use HasFactory;

    protected $table = 'actual_user';

    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email',
        'referral_id',
        'inviting_id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
