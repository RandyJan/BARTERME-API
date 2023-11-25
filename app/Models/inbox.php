<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class inbox extends Model
{
    use HasFactory,HasApiTokens;

    protected $table = 'dbo.inbox';
    protected $fillable=[
        'user_id',
        'conv_id',
        'email_a',
        'email_b',
        'chatname',
        'chatnameb'

    ];
}
