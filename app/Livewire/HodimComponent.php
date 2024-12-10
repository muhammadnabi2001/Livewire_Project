<?php

namespace App\Livewire;

use App\Models\Hodim;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class HodimComponent extends Component
{
    use WithPagination;

    public $users;
    public $check;
    public $allow;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $this->users=User::all();
        $hodimlar=Hodim::orderBy('id','desc')->paginate(10);
        return view('livewire.hodim-component',compact('hodimlar'));
    }
}
