<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable=[
        'hodim_id',
        'type',
        'date',
        'oylik',
        'berildi',
        'qolgan'
    ];
    public function hodim()
    {
        return $this->belongsTo(Hodim::class, 'hodim_id', 'id');
    }
}
