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
   
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function hodim()
    {
        return $this->belongsTo(Hodim::class,'hodim_id');
    }
}
