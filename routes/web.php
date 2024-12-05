<?php

use App\Livewire\CategoryComponent;
use App\Livewire\HomeComponent;
use App\Livewire\MealComponent;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/',HomeComponent::class);
Route::get('/categories',CategoryComponent::class);
Route::get('meals',MealComponent::class);
