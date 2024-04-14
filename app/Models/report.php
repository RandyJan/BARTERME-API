<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class report extends Model
{
    use HasFactory;
    protected $table = 'report';

    protected $fillable = [
        'email',
        'img1',
        'img2',
        'report_note',
        'reported'

    ];
}
