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
    

    Route::get('food',[App\Http\Controllers\FoodController::class, 'index'])->name('food');

    //Category Controller
    Route::get('category',[App\Http\Controllers\CategoryController::class, 'index'])->name('category');
    Route::post('user/category',[App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
    Route::get('user/category/edit',[App\Http\Controllers\CategoryController::class,'edit'])->name('category.edit');
    Route::post('user/category/update',[App\Http\Controllers\CategoryController::class,'update'])->name('category.update');
    Route::post('user/category/delete',[App\Http\Controllers\CategoryController::class,'destroy'])->name('category.delete');
    Route::get('user/category/search',[App\Http\Controllers\CategoryController::class,'search'])->name('category.search');
});


Auth::routes();
//Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');