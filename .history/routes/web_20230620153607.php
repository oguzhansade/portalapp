<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['namespace' => 'formcraft', 'as' => 'formcraft.', 'prefix' => 'formcraft'], function () {
    Route::get('/form', [App\Http\Controllers\front\formcraft\indexController::class, 'form'])->name('form');
    

});

Route::get('/formcraft', [App\Http\Controllers\front\formcraft\FormCraftController::class, 'handleFormData'])->name('handleFormData');