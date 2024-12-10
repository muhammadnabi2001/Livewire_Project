<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bulim extends Model
{
    protected $fillable=[
        'name'
    ];
    public function hodim()
    {
        return $this->hasMany(Hodim::class,'bulim_id');
    }
}
