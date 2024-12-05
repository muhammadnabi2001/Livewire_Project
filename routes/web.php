<?php

use App\Livewire\CartComponent;
use App\Livewire\CategoryComponent;
use App\Livewire\HomeComponent;
use App\Livewire\MealComponent;
use App\Livewire\SelectedMealbyCategory;
use App\Livewire\UsersComponent;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/',HomeComponent::class);
Route::get('/categories',CategoryComponent::class);
Route::get('/meals',MealComponent::class);
Route::get('/userpage',UsersComponent::class);
Route::get('/swap/{id}',SelectedMealbyCategory::class)->name('swap');
Route::get('carts',CartComponent::class)->name('carts');