<?php

use App\Livewire\CartComponent;
use App\Livewire\CategoryComponent;
use App\Livewire\CheckComponent;
use App\Livewire\ForgotpasswordComponent;
use App\Livewire\HomeComponent;
use App\Livewire\LoginComponent;
use App\Livewire\MealComponent;
use App\Livewire\OrderComponent;
use App\Livewire\SelectedMealbyCategory;
use App\Livewire\UsersComponent;
use App\Livewire\VerificationComponent;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/',HomeComponent::class);
Route::get('/categories',CategoryComponent::class);
Route::get('/meals',MealComponent::class);
Route::get('/userpage',UsersComponent::class)->name('userpage');
Route::get('/carts',CartComponent::class)->name('carts');
Route::get('/orders',OrderComponent::class)->name('orders');
Route::get('/login',LoginComponent::class)->name('login');
Route::get('forgotpassword',ForgotpasswordComponent::class)->name('forgotpassword');