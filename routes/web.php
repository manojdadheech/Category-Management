<?php

use App\Http\Controllers\CategoryController;
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
    return redirect(route('categories.index'));
});
Route::resource('categories', CategoryController::class);
Route::get('categories/create', [CategoryController::class, 'create'])
    ->middleware('admin')
    ->name('categories.create');

Auth::routes();

Route::get('/home', function () {
    return redirect(route('categories.index'));
})->name('home');
