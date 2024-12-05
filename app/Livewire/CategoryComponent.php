<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryComponent extends Component
{
    public $check = false;
    public $name;
    public $allow=false;
    public $editname;
    public $editsort;
    protected $rules = [
        'name' => 'required|max:255|min:3'
        
    ];
    public function update($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        $categories = Category::orderBy('sort', 'asc')->get();
        return view('livewire.category-component', compact('categories'));
    }
    public function Create()
    {
        $this->check = true;
    }
    public function back()
    {
        $this->check = false;
    }
    public function store()
    {
        //dd($this->name);
        $validateData = $this->validate();
        Category::create($validateData);
        $this->check=false;
        $this->reset('name');
    }
    public function change(Category $category)
    {
        //dd($id);
        $this->allow=$category->id;
        $this->editname=$category->name;
        $this->editsort=$category->sort;
    }
    public function edit()
    {
        $this->validate([
            'editname' => 'required|max:255|min:3',
            'editsort' => 'required|integer|min:1',
        ]);

        $category = Category::find($this->allow);
        $category->update([
            'name' => $this->editname,
            'sort' => $this->editsort,
        ]);
        $this->allow=false;
    }
    public function delete(Category $category)
    {
        if($category)
        {
            $category->delete();
        }
    }
    public function messages()
    {
        return [
            'name.required' => 'Kategoriya nomi talab qilinadi.',
            'name.max' => 'Kategoriya nomi 255 belgidan oshmasligi kerak.',
            'name.min' => 'Kategoriya nomi kamida 3 belgidan iborat bo‘lishi kerak.',
            'editname.required' => 'Tahrir nomi talab qilinadi.',
            'editname.max' => 'Tahrir nomi 255 belgidan oshmasligi kerak.',
            'editname.min' => 'Tahrir nomi kamida 3 belgidan iborat bo‘lishi kerak.',
            'editsort.required' => 'Saralash tartibi talab qilinadi.',
            'editsort.integer' => 'Saralash tartibi to‘g‘ri raqam bo‘lishi kerak.',
            'editsort.min' => 'Saralash tartibi kamida 1 bo‘lishi kerak.',
        ];
    }
   
}
