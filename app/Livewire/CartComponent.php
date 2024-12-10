<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Meal;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Livewire\WithPagination;


class CartComponent extends Component
{
    use WithPagination;
    public $carts = [];
    public $food;
    public $categories;
    public $filterCategory = null;
    protected $paginationTheme = 'bootstrap';
    public $allow=false;
    public function render()
    {
        //dd(session('cart'));
        $this->carts = session('cart', []);
        //dd($this->carts);
        $meals = Meal::when($this->filterCategory, function ($query) {
            $query->where('category_id', $this->filterCategory);
        })->orderBy('id', 'desc')->paginate(6);

        $this->categories = Category::all();
        return view('livewire.cart-component', compact('meals'))->layout('components.Layout.main');
    }
    public function add($id)
    {
        $food = session()->get('cart', []);
        $food[$id]['quantity'] = $food[$id]['quantity'] + 1;
        session()->put('cart', $food);
    }
    public function take($id)
    {
        $food = session()->get('cart', []);
        $food[$id]['quantity'] = $food[$id]['quantity'] - 1;
        session()->put('cart', $food);
    }
    public function unset($id)
    {
        $remove = session()->get('cart', []);

        if (isset($remove[$id])) {
            unset($remove[$id]);
        }

        session()->put('cart', $remove);
    }
    public function order($total)
    {
        //dd($total);
        //dd(123);
        $foods = session('cart', []);
        $queue = Order::where('date', date('Y-m-d'))->count();
        $order = Order::create([
            'date' => date('Y-m-d'),
            'queue' => $queue + 1,
            'summ' => $total,
            'status' => 1
        ]);

        foreach ($foods as $key => $food) {
            OrderItem::create([
                'order_id' => $order->id,
                'meal_id' => $key,
                'count' => $food['quantity'],
                'total_price' => $food['price'] * $food['quantity'],
            ]);
        }

        session()->forget('cart');
        return redirect()->to('/userpage');
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
        $this->allow=true;
        $this->filterCategory = $id; // Tanlangan kategoriya ID'sini o'zgartirish
        $this->resetPage(); // Paginationni boshiga qaytarish
    }
}
