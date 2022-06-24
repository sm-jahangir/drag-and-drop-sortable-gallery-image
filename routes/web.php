<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
//route
Route::get('/', [ItemController::class, 'itemView']);
Route::post('/update-items', [ItemController::class, 'updateItems'])->name('update.items');

// 
Route::get('/backend/category', [ItemController::class, 'index']);
Route::post('/backend/category', [ItemController::class, 'store'])->name('category.items');

//
Route::get('/tag', [ItemController::class, 'tagindex']);
Route::post('/tag', [ItemController::class, 'tagstore'])->name('tag.items');

Route::resource('category', CategoryController::class);
