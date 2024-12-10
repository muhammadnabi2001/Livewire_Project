<?php

namespace App\Livewire;

use App\Models\Bulim;
use Livewire\Component;
use Livewire\WithPagination;

class BulimComponent extends Component
{
    use WithPagination;

    public $check=false;
    public $allow=false;
    public $name;
    public $editname;
    public $rules=[
        'name'=>'required|min:8|max:255'
    ];
    protected $paginationTheme = 'bootstrap';

    public function update($data)
    {
        $this->validateOnly($data);
    }
    public function render()
    {
        $bulims=Bulim::orderBy('id','desc')->paginate(10);
        return view('livewire.bulim-component',compact('bulims'));
    }
    public function Create()
    {
        $this->check=true;
    }
    public function Back()
    {
        $this->check=false;
    }
    public function store()
    {
        $validatedata=$this->validate();
        Bulim::create($validatedata);
        $this->check=false;
        $this->reset('name');
    }
    public function change(Bulim $bulim)
    {
        //dd($id);
        $this->allow=$bulim->id;
        $this->editname=$bulim->name;
    }
    public function edit()
    {
        $this->validate([
            'editname' => 'required|max:255|min:3',
        ]);

        $bulim = Bulim::findOrFail($this->allow);
        $bulim->update([
            'name' => $this->editname,
        ]);
        $this->allow=false;
    }
    public function delete(Bulim $bulim)
    {
        if($bulim)
        {
            $bulim->delete();
        }
    }
    public function messages()
    {
        return [
            'name.required' => 'Ism maydoni to‘ldirilishi shart.',
            'name.max' => 'Ism 255 ta belgidan oshmasligi kerak.',
            'name.min' => 'Ism kamida 3 ta belgi bo‘lishi kerak.',
            'editname.required' => 'Tahrir nomi talab qilinadi.',
            'editname.max' => 'Tahrir nomi 255 belgidan oshmasligi kerak.',
            'editname.min' => 'Tahrir nomi kamida 3 belgidan iborat bo‘lishi kerak.',
        ];
    }
}
