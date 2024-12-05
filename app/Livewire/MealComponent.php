<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Meal;
use Livewire\Component;
use Livewire\WithFileUploads;

class MealComponent extends Component
{
    use WithFileUploads; 
    public $meals;
    public $categories;
    public $allow;
    public $check=false;

    public $file;
    public $extension;
    public $filename;

    public $name;
    public $category_id;
    public $price;
    public $img;
    protected $rules = [
        'name' => 'required|max:255',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric',
        'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    public function update($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        $this->meals=Meal::orderBy('id','desc')->get();
        $this->categories=Category::all();
        return view('livewire.meal-component');
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
    $this->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|integer|exists:categories,id',
        'price' => 'required|numeric',
        'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($this->img) {
        $this->file=$_FILES['img'];
        dd($this->file);
        $this->extension = $this->img->getClientOriginalExtension();
        $this->filename = date("Y-m-d") . '_' . time() . '.' . $this->extension;
        $this->img->move('img_uploaded/', $this->filename);
    }

    Meal::create([
        'name' => $this->name,
        'category_id' => $this->category_id,
        'price' => $this->price,
        'img' => isset($this->filename) ? 'img_uploaded/' . $this->filename : null,
    ]);

    $this->reset();

    session()->flash('success', 'Yangi taom muvaffaqiyatli qo‘shildi!');
}

    
    

    public function messages()
    {
        return [
            'name.required' => 'Meal name is required.',
            'name.max' => 'Meal name should not exceed 255 characters.',
            'category_id.required' => 'Category is required.',
            'category_id.exists' => 'The selected category is invalid.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a number.',
            'img.required' => 'Image is required.',
            'img.image' => 'The file must be an image.',
            'img.mimes' => 'Only jpeg, png, jpg, gif images are allowed.',
            'img.max' => 'Image size should not exceed 2MB.',
        ];
    }
}
