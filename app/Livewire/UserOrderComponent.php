<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\UserOrder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserOrderComponent extends Component
{
    public $orders;
    public $jarayonda;
    public $allow = false;
    public $permission = false;
    public $tayyor;
    public $tayyorpermit = false;
    public $yetkazilgan;
    public $licence = false;
    public function render()
    {
        $this->orders = Order::orderBy('queue', 'asc')->where('status', 1)->where('date', now()->toDateString())->get();
        $this->jarayonda = Order::orderBy('queue', 'asc')->where('status', 3)->where('date', now()->toDateString())->get();
        $this->tayyor = Order::orderBy('queue', 'asc')->where('status', 4)->where('date', now()->toDateString())->get();
        $this->yetkazilgan = Order::orderBy('queue', 'asc')->where('status', 5)->where('date', now()->toDateString())->get();
        return view('livewire.user-order-component');
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
    public function qabul($id)
    {
        //dd(123);
        $user = Auth::user();
        // dd($user->role);
        $order = Order::findOrFail($id);

        $order->status = 5;
        $order->save();

        foreach ($order->orderItems as $orderItem) {
            $orderItem->status = 5;
            $orderItem->save();
        }
        UserOrder::create([
            'hodim_id' => $user->hodim->id,
            'order_id' => $id
        ]);
    }
}
