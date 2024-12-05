<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Meal;
use Livewire\Component;

class UsersComponent extends Component
{
    public $food;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $meals = Meal::orderBy('id', 'desc')->paginate(6);
        $categories = Category::all();
        return view('livewire.users-component', compact('meals','categories'))->layout('components.Layout.main', ['categories' => $categories]);
    }
    public function addToCart($mealId)
    {
        $this->food = Meal::findOrFail($mealId);
        //dd($food);
        if ($this->food) {
            $cart = session()->get('cart', []);

            if (isset($cart[$mealId])) {
                $cart[$mealId]['quantity']++;
            } else {
                $cart[$mealId] = [
                    'name' => $this->food->name,
                    'price' => $this->food->price,
                    'category_id'=>$this->food->category_di,
                    'img'=>$this->food->img,
                    'quantity' => 1,
                ];
            }
            session()->put('cart', $cart);
        }
    }
}
