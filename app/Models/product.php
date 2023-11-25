<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class product extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = 'dbo.product';
    protected $fillable = [
        'email',
        'prod_id',
        'prod_name',
        'price',
        'desc',
        'category',
        'image',
        'isTraded',
        'username',
        'user_img'
    ];
    public $timestamps = false;

}
