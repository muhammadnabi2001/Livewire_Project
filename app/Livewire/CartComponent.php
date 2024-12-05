<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Meal;
use Livewire\Component;

class CartComponent extends Component
{
    public function render()
    {
       $meals=Meal::orderBy('id','desc')->paginate(6);
        $categories=Category::all();
        return view('livewire.cart-component',compact('meals'))->layout('components.Layout.main',['categories'=>$categories]);
    }
}
