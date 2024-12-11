<?php

use App\Http\Middleware\Check;
use App\Livewire\BulimComponent;
use App\Livewire\CartComponent;
use App\Livewire\CategoryComponent;
use App\Livewire\CheckComponent;
use App\Livewire\ForgotpasswordComponent;
use App\Livewire\HodimComponent;
use App\Livewire\HomeComponent;
use App\Livewire\LoginComponent;
use App\Livewire\MealComponent;
use App\Livewire\OrderComponent;
use App\Livewire\SelectedMealbyCategory;
use App\Livewire\UserComponent;
use App\Livewire\UsersComponent;
use App\Livewire\VerificationComponent;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/',LoginComponent::class);
Route::get('/logout', LoginComponent::class . '@logout');
Route::get('/home',HomeComponent::class);
Route::get('/categories',CategoryComponent::class)->middleware(Check::class.':admin');
Route::get('/meals',MealComponent::class)->middleware(Check::class.':admin');
Route::get('/userpage',UsersComponent::class)->name('userpage');
Route::get('/carts',CartComponent::class)->name('carts');
Route::get('/orders',OrderComponent::class)->name('orders');
Route::get('/forgotpassword',ForgotpasswordComponent::class)->name('forgotpassword');
Route::get('/users',UserComponent::class)->name('users')->middleware(Check::class.':admin');
Route::get('bulim',BulimComponent::class)->name('bulim')->middleware(Check::class.':admin');
Route::get('hodim',HodimComponent::class)->name('hodim')->middleware(Check::class.':admin');