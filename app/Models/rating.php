<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';
    protected $fillable = [
        'ratings',
        'user',
        'customer'
    ];

    public $timestamps = false;
}
