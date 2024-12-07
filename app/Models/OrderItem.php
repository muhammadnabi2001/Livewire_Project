<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable=[
        'order_id',
        'meal_id',
        'count',
        'total_price',
        'status'
    ];
}