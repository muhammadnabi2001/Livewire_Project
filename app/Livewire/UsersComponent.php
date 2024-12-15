<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Meal;
use Livewire\Component;
use Livewire\WithPagination;

class UsersComponent extends Component
{
    use WithPagination;

    public $food;
    public $categories;
    public $filterCategory = null; 

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $meals = Meal::when($this->filterCategory, function ($query) {
            $query->where('category_id', $this->filterCategory);
        })->orderBy('id', 'desc')->paginate(6);

        $this->categories = Category::all();

        return view('livewire.users-component', compact('meals'))
            ->layout('components.Layout.main');
    }

    public function addToCart($mealId)
    {
        $this->food = Meal::findOrFail($mealId);
        if ($this->food) {
            $cart = session()->get('cart', []);
            
            if (isset($cart[$mealId])) {
                $cart[$mealId]['quantity']++;
            } else {
                $cart[$mealId] = [
                    'name' => $this->food->name,
                    'price' => $this->food->price,
                    'category_id' => $this->food->category_id,
                    'img' => $this->food->img,
                    'quantity' => 1,
                ];
            }
            
            session()->put('cart', $cart);
        }
      // session()->forget('cart');
    }

    public function swap($id)
    {
        $this->filterCategory = $id; 
        $this->resetPage(); 
    }
}
