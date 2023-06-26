<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Usercontroller;
use Illuminate\Database\Query\IndexHint;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/admin/products', ProductsController::class);
Route::resource('/admin/categories', CategoriesController::class);
//Route::resource('/admin/categories', CategoryController::class);

Route::get('/admin/products/trashed', [ProductsController::class, 'trashed'])
    ->name('products.trashed');

Route::put('/admin/products/{product}/restore', [ProductsController::class, 'restore'])
    ->name('products.restore');

Route::delete('/admin/produts/{product}/force', [ProductsController::class, 'forceDelete'])
    ->name('products.force.delete');

Route::resource('/admin/products', ProductsController::class);

Route::get('/Users', [Usercontroller::class, 'index']);
Route::get('/Users/info', [Usercontroller::class, 'info']);
Route::get('/Users/info', [Usercontroller::class, 'show']);
Route::get('/Users/{first}', [Usercontroller::class, 'show']);
// Route::get('/admin/products',[ProductsController::class,'index'])->name('products.index');
// Route::get('/admin/products/create',[ProductsController::class,'create']);
// Route::post('/admin/products',[ProductsController::class,'store']);
// Route::get('/admin/products/{id}',[ProductsController::class,'show']);
// Route::get('/admin/products/{id}/edit',[ProductsController::class,'edit']);
// Route::put('/admin/products/{id}',[ProductsController::class,'update']);
// Route::delete('/admin/products/{id}',[ProductsController::class,'destroy']);
//http://127.0.0.1.8000/Users/