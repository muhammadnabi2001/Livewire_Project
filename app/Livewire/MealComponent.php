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
    public $check = false;

    public $file;
    public $extension;
    public $filename;

    public $name;
    public $category_id;
    public $price;
    public $img;

    public $editname;
    public $editcategory_id;
    public $editprice;
    public $editimg;
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
        $this->meals = Meal::orderBy('id', 'desc')->get();
        $this->categories = Category::all();
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
        $this->validate();

        if ($this->img) {
            $this->extension = $this->img->getClientOriginalExtension();
            $this->filename = date("Y-m-d") . '_' . time() . '.' . $this->extension;

            $path = $this->img->storeAs('img_uploaded', $this->filename, 'public');
        }

        Meal::create([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'img' => $path,
        ]);

        $this->reset();
    }
    public function change(Meal $meal)
    {
        //dd($id);
        $this->allow = $meal->id;
        $this->editname = $meal->name;
        $this->editcategory_id = $meal->category_id;
        $this->editprice = $meal->price;
        $this->editimg = $meal->editimg;
    }
    public function edit()
    {
        $this->validate([
            'editname' => 'required|string|max:255',
            'editcategory_id' => 'required|exists:categories,id',
            'editprice' => 'required|numeric',
            'editimg' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        if ($this->editimg) {
            $this->extension = $this->editimg->getClientOriginalExtension();
            $this->filename = date("Y-m-d") . '_' . time() . '.' . $this->extension;
            $path = $this->editimg->storeAs('img_uploaded', $this->filename, 'public');
        } else {
            $path = Meal::findOrFail($this->allow)->img;
        }

        $food = Meal::findOrFail($this->allow);
        $food->update([
            'name' => $this->editname,
            'category_id' => $this->editcategory_id,
            'price' => $this->editprice,
            'img' => $path,
        ]);

        $this->allow = false;
    }
    public function delete(Meal $meal)
    {
        $meal->delete();
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
            'editname.required' => 'Meal name is required.',
            'editname.max' => 'Meal name should not exceed 255 characters.',
            'editcategory_id.required' => 'Category is required.',
            'editcategory_id.exists' => 'The selected category is invalid.',
            'editprice.required' => 'Price is required.',
            'editprice.numeric' => 'Price must be a number.',
            'editimg.required' => 'Image is required.',
            'editimg.image' => 'The file must be an image.',
            'editimg.mimes' => 'Only jpeg, png, jpg, gif images are allowed.',
            'editimg.max' => 'Image size should not exceed 2MB.',
        ];
    }
}
