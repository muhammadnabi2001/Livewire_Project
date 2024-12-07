<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'date',
        'queue',
        'summ',
        'status'
    ];
    
}
