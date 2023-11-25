<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class message extends Model
{
    use HasFactory,HasApiTokens;

    protected $table = "dbo.conversation";
    protected $fillable = [
        'conv_id',
        'sender',
        'message',
        'date',
        'conv_participant_a',
        'conv_participant_b',
        'img_a',
        'img_b',
        'receiver'
    ];
    public $timestamps = false;
}
