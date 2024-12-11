<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $fillable=[
        'hodim_id',
        'user_id',
        'start_time',
        'end_time',
        'date',
        'time'
    ];
}
