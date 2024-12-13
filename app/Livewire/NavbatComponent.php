<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class NavbatComponent extends Component
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
        return view('livewire.navbat-component');
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
}
