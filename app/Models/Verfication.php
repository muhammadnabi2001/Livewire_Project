<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verfication extends Model
{
    protected $fillable=[
        'user_id',
        'code'
    ];
}
