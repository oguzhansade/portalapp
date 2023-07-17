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
Route::get('/schnellanform', [App\Http\Controllers\front\formcraft\FormCraftController::class, 'handleSchnellanfrageForm'])->name('handleSchnellanfrageForm');
Route::get('/privatumzugform', [App\Http\Controllers\front\formcraft\FormCraftController::class, 'handlePrivatumzugForm'])->name('handlePrivatumzugForm');
Route::get('/kontaktform', [App\Http\Controllers\front\formcraft\FormCraftController::class, 'handleKontaktForm'])->name('handleKontaktForm');
Route::get('/reinigungform', [App\Http\Controllers\front\formcraft\FormCraftController::class, 'handleReinigungForm'])->name('handleReinigungForm');
Route::get('/firmenform', [App\Http\Controllers\front\formcraft\FormCraftController::class, 'handleFirmenForm'])->name('handleFirmenForm');
Route::get('/mailTester', [App\Http\Controllers\front\formcraft\FormCraftController::class, 'handleFirmenForm'])->name('handleFirmenForm');
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


