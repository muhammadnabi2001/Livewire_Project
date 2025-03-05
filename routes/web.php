<?php

use App\Http\Middleware\Check;
use App\Livewire\BulimComponent;
use App\Livewire\CartComponent;
use App\Livewire\CategoryComponent;
use App\Livewire\CheckComponent;
use App\Livewire\FixedSalaryComponent;
use App\Livewire\ForgotpasswordComponent;
use App\Livewire\GiveSalaryComponent;
use App\Livewire\HodimComponent;
use App\Livewire\HomeComponent;
use App\Livewire\JurnalComponent;
use App\Livewire\KpiSalaryComponent;
use App\Livewire\LoginComponent;
use App\Livewire\MealComponent;
use App\Livewire\NavbatComponent;
use App\Livewire\OrderComponent;
use App\Livewire\SelectedMealbyCategory;
use App\Livewire\UserComponent;
use App\Livewire\UserOrderComponent;
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
Route::get('jurnal',JurnalComponent::class)->name('jurnal')->middleware(Check::class.':admin');
Route::get('afitsant',UserOrderComponent::class)->name('afitsant')->middleware(Check::class.':afitsant');
Route::get('navbat',NavbatComponent::class)->name('navbat');
Route::get('fixedsalary',FixedSalaryComponent::class)->name('fixedsalary');
Route::get('kpisalary',KpiSalaryComponent::class)->name('kpisalary');
Route::get('givesalary',GiveSalaryComponent::class)->name('givesalary');