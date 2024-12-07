<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Meal;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class CartComponent extends Component
{
    public $carts=[];
    public function render()
    {
        //dd(session('cart'));
        $this->carts = session('cart');
        //dd($this->carts);
        return view('livewire.cart-component')->layout('components.Layout.cart');
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
            'status'=>1
        ]);

        foreach ($foods as $key=>$food) {
            OrderItem::create([
                'order_id' => $order->id,
                'meal_id' => $key,
                'count' => $food['quantity'],
                'total_price' => $food['price']*$food['quantity'],
            ]);
        }

        session()->forget('cart');
        return redirect('/userpage');
    }
}
