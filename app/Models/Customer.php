<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'phone',
    ];

    protected $hidden = [
        'crated_at',
        'updated_at',
    ];
}
