<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class OrderComponent extends Component
{
    public $orders;
    public $jarayonda;
    public $allow = false;
    public $permission = false;
    public $tayyor;
    public $tayyorpermit=false;
    public $topshirilgan;
    public $licence=false;
    public function render()
    {
        $this->orders = Order::orderBy('queue', 'asc')->where('status', 1)->where('date', now()->toDateString())->get();
        $this->jarayonda = Order::orderBy('queue', 'asc')->where('status', 2)->where('date', now()->toDateString())->get();
        $this->tayyor=Order::orderBy('queue','asc')->where('status',3)->where('date',now()->toDateString())->get();
        $this->topshirilgan=Order::orderBy('queue','asc')->where('status',4)->where('date',now()->toDateString())->get();
        return view('livewire.order-component');
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
    public function accept($id)
    {
        // dd($id);
        $order = Order::findOrFail($id);

        $order->status = 2;
        $order->save();

        foreach ($order->orderItems as $orderItem) {
            $orderItem->status = 2;
            $orderItem->save();
        }
        $this->allow=false;
    }
    public function ruxsat($id)
    {
        if ($id == $this->allow) {
            $this->allow = false;
        } else {
            $this->allow = $id;
        }
    }
    public function done($id)
    {
        $currentOrderItem = OrderItem::findOrFail($id);

        if (!$currentOrderItem) {
            return;
        }

        $currentOrderItem->status = $currentOrderItem->status == 3 ? 2 : 3;
        $currentOrderItem->save();

        $otherOrderItems = OrderItem::where('id', '!=', $id)
            ->where('order_id', $currentOrderItem->order_id)
            ->get();

        $checkedCount = $otherOrderItems->where('status', 3)->count();

        $totalCount = $otherOrderItems->count();

        $order = $currentOrderItem->order;

        if ($checkedCount == $totalCount) {
            $order->status = 3;
        } else {
            $order->status = 2;
        }

        $order->save();
    }
    public function consent($id)
    {
        if ($id == $this->tayyorpermit) {
            $this->tayyorpermit = false;
        } else {
            $this->tayyorpermit = $id;
        }
    }
    public function topshirish($id)
    {
        $order = Order::findOrFail($id);

        $order->status = 4;
        $order->save();

        foreach ($order->orderItems as $orderItem) {
            $orderItem->status = 4;
            $orderItem->save();
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
}
