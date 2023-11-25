<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bundle extends Model
{
    use HasFactory;
    protected $table = 'dbo.bundle';
    protected $fillable = [
        'prod_name',
        'user',
        'desc',
        'price',
        'bundle_id',
        'prod_id'
    ];

    public $timestamps = false;
    public $incrementing = false;
}
