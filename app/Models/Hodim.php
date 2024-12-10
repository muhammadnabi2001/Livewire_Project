<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hodim extends Model
{
    protected $fillable=[
        'user_id',
        'bulim_id',
        'img',
        'oylik_type',
        'oylik_miqdor',
        'bonus',
        'start_time',
        'end_time',
        'kunlik_time',
        'oylik_time'
    ];
}
