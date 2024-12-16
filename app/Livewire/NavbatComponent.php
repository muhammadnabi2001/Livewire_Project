<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Meal;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class NavbatComponent extends Component
{
    use WithPagination;
    public $kursat=false;
    public $food;
    public $orders;
    public $jarayonda;
    public $allow = false;
    public $permission = false;
    public $tayyor;
    public $tayyorpermit = false;
    public $topshirilgan;
    public $licence = false;
    public $categories;
    public $filterCategory;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $meals = Meal::when($this->filterCategory, function ($query) {
            $query->where('category_id', $this->filterCategory);
        })->orderBy('id', 'desc')->paginate(6);

        $this->categories = Category::all();
        $this->orders = Order::orderBy('queue', 'asc')->where('status', 1)->where('date', now()->toDateString())->get();
        $this->jarayonda = Order::orderBy('queue', 'asc')->where('status', 2)->where('date', now()->toDateString())->get();
        $this->tayyor = Order::orderBy('queue', 'asc')->where('status', 3)->where('date', now()->toDateString())->get();
        $this->topshirilgan = Order::orderBy('queue', 'asc')->where('status', 4)->where('date', now()->toDateString())->get();
        return view('livewire.navbat-component',compact('meals'))->layout('components.Layout.main');
    }
    public function show($id)
    {
        //dd($id);
        if ($id == $this->permission) {
            $this->permission = false;
        } else {
            $this->permission = $id;
        }
    }
    public function ruxsat($id)
    {
        if ($id == $this->allow) {
            $this->allow = false;
        } else {
            $this->allow = $id;
        }
    }
    public function consent($id)
    {
        if ($id == $this->tayyorpermit) {
            $this->tayyorpermit = false;
        } else {
            $this->tayyorpermit = $id;
        }
    }
    public function see($id)
    {
        //dd($id);
        if ($id == $this->licence) {
            $this->licence = false;
        } else {
            $this->licence = $id;
        }
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
        $this->kursat=true;
        $this->resetPage();
    }
}
