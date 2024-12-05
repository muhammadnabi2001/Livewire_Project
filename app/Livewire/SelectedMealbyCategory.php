<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Meal;
use Livewire\Component;
use Livewire\WithPagination;

class SelectedMealbyCategory extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $categoryId;
    public function mount($id)
    {
        $this->categoryId=$id;
        //dd($id);
    }
    public function render()
    {
        $meals=Meal::orderBy('id','desc')->where('category_id',$this->categoryId)->paginate(3);
        $categories=Category::all();
        return view('livewire.selected-mealby-category',compact('meals'))->layout('components.Layout.main',['categories'=>$categories]);
    }
}
