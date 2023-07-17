<?php

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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::post('/formcraft', [App\Http\Controllers\front\formcraft\FormCraftController::class, 'handleFormData'])->name('handleFormData');




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


