<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function (){

    Route::get('dashboard',[App\Http\Controllers\DashboardController::class,'index'])->name('dashboard'); 
    
    //UserController
    Route::get('user',[App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::get('user/create',[App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::post('user/store',[App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('user/view/{id}',[App\Http\Controllers\UserController::class,'view'])->name('user.view');
    Route::get('user/edit/{id}',[App\Http\Controllers\UserController::class,'edit'])->name('user.edit');
    Route::post('user/update/{id}',[App\Http\Controllers\UserController::class,'update'])->name('user.update');
    // Route::get('user/delete/{id}',[App\Http\Controllers\UserController::class,'delete'])->name('user.delete');
    Route::post('user/delete',[App\Http\Controllers\UserController::class,'destroy'])->name('user.delete');
    Route::get('user/search',[App\Http\Controllers\UserController::class,'search'])->name('user.search');
    
    //Food Controller
    Route::get('food',[App\Http\Controllers\FoodController::class, 'index'])->name('food');
    Route::post('user/food',[App\Http\Controllers\FoodController::class,'store'])->name('food.store');
    Route::get('user/food/edit',[App\Http\Controllers\FoodController::class,'edit'])->name('food.edit');
    Route::post('user/food/update',[App\Http\Controllers\FoodController::class,'update'])->name('food.update');
    Route::post('user/food/delete',[App\Http\Controllers\FoodController::class,'destroy'])->name('food.delete');
    Route::get('user/food/search',[App\Http\Controllers\FoodController::class,'search'])->name('food.search');

    //Category Controller
    Route::get('category',[App\Http\Controllers\CategoryController::class, 'index'])->name('category');
    Route::post('user/category',[App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
    Route::get('user/category/edit',[App\Http\Controllers\CategoryController::class,'edit'])->name('category.edit');
    Route::post('user/category/update',[App\Http\Controllers\CategoryController::class,'update'])->name('category.update');
    Route::post('user/category/delete',[App\Http\Controllers\CategoryController::class,'destroy'])->name('category.delete');
    Route::get('user/category/search',[App\Http\Controllers\CategoryController::class,'search'])->name('category.search');

    //Tables Controller

    Route::get('tables',[App\Http\Controllers\TablesController::class,'index'])->name('tables');
    Route::post('user/tables',[App\Http\Controllers\TablesController::class,'store'])->name('tables.store');
    Route::get('user/tables/edit',[App\Http\Controllers\TablesController::class,'edit'])->name('tables.edit');
    Route::post('user/tables/update',[App\Http\Controllers\TablesController::class,'update'])->name('tables.update');
    Route::post('user/tables/delete',[App\Http\Controllers\TablesController::class,'destroy'])->name('tables.delete');
    Route::get('user/tables/search',[App\Http\Controllers\TablesController::class,'search'])->name('tables.search');
    
     //Menu Controller
    Route::get('menu',[App\Http\Controllers\MenuController::class,'index'])->name('menu');
    Route::get('user/getfood/{id}',[App\Http\Controllers\FoodController::class,'show'])->name('getfood');
    Route::get('user/getitem/{id}',[App\Http\Controllers\MenuController::class,'show'])->name('getitem');
    Route::get('user/showfood/{id}',[App\Http\Controllers\FoodController::class,'show_food'])->name('show_food');


    Route::post('user/menu',[App\Http\Controllers\MenuController::class,'store'])->name('menu.store');
    Route::get('user/menu/edit',[App\Http\Controllers\MenuController::class,'edit'])->name('menu.edit');
    Route::post('user/menu/update',[App\Http\Controllers\MenuController::class,'update'])->name('menu.update');
    Route::post('user/menu/delete',[App\Http\Controllers\MenuController::class,'destroy'])->name('menu.delete');
    Route::get('user/menu/search',[App\Http\Controllers\MenuController::class,'search'])->name('menu.search');

    Route::get('user/menu_item/{id}',[App\Http\Controllers\MenuController::class,'create'])->name('menu.additem');
    Route::post('user/menu_item',[App\Http\Controllers\MenuController::class,'store_item'])->name('menu.store_item');
    Route::post('user/menu_item/delete',[App\Http\Controllers\MenuController::class,'destroy_item'])->name('menu.delete_item');
    
    
    // CashierController
    Route::get('/home', [App\Http\Controllers\CashierController::class, 'index'])->name('home');
    
    //add_to_cart
    Route::post('/home/add_to_cart',[App\Http\Controllers\CashierController::class,'add_to_cart'])->name('add_to_cart');

    //CustomerController
    Route::get('/home/customer',[App\Http\Controllers\CustomerController::class,'index'])->name('customer');
    Route::post('/home/customer/store',[App\Http\Controllers\CustomerController::class,'store'])->name('customer.store');
    Route::get('/home/customer/edit',[App\Http\Controllers\CustomerController::class,'edit'])->name('customer.edit');
    Route::post('/home/customer/update',[App\Http\Controllers\CustomerController::class,'update'])->name('customer.update');
    Route::post('/home/customer/delete',[App\Http\Controllers\CustomerController::class,'destroy'])->name('customer.delete');
    Route::get('/home/customer/search',[App\Http\Controllers\CustomerController::class,'search'])->name('customer.search');
});


Auth::routes();
//Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');