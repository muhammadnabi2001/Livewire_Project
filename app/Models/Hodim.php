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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function bulim()
    {
        return $this->belongsTo(Bulim::class,'bulim_id');
    }
}
