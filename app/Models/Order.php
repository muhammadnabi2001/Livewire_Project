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
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class,'order_id');
    }
}
