<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=[
        'name',
        'sort'
    ];
    public function meals()
    {
        return $this->hasMany(Meal::class,'category_id');
    }
}
