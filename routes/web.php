<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
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

// Clear application cache:
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return 'Application cache has been cleared';
});

//Clear route cache:
Route::get('/route-cache', function() {
	Artisan::call('route:cache');
    return 'Routes cache has been cleared';
});

//Clear config cache:
Route::get('/config-cache', function() {
 	Artisan::call('config:cache');
 	return 'Config cache has been cleared';
}); 

// Clear view cache:
Route::get('/view-clear', function() {
    Artisan::call('view:clear');
    return 'View cache has been cleared';
});

Route::get('/schnellanform', [App\Http\Controllers\front\formcraft\FormCraftController::class, 'handleSchnellanfrageForm'])->name('handleSchnellanfrageForm');
Route::get('/privatumzugform', [App\Http\Controllers\front\formcraft\FormCraftController::class, 'handlePrivatumzugForm'])->name('handlePrivatumzugForm');
// Route::get('/kontaktform', [App\Http\Controllers\front\formcraft\FormCraftController::class, 'handleKontaktForm'])->name('handleKontaktForm');
Route::get('/reinigungform', [App\Http\Controllers\front\formcraft\FormCraftController::class, 'handleReinigungForm'])->name('handleReinigungForm');
Route::get('/firmenform', [App\Http\Controllers\front\formcraft\FormCraftController::class, 'handleFirmenForm'])->name('handleFirmenForm');
Route::get('/mailTester', [App\Http\Controllers\front\formcraft\FormCraftController::class, 'mailTester'])->name('mailTester');

Auth::routes(['register' => false]);

Route::group(['namespace' => 'front', 'middleware' => ['auth']], function () {
    Route::group(['namespace' => 'home', 'as' => 'home.'], function () {
        Route::get('/', [App\Http\Controllers\front\home\indexController::class, 'index'])->name('index');
    });
    Route::group(['namespace' => 'firma', 'as' => 'firma.','prefix' => 'firma','middleware' => ['CheckFirmaId']], function () {
            Route::get('/', [App\Http\Controllers\front\firma\indexController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\front\firma\indexController::class, 'create'])->name('create');
            Route::post('/create', [App\Http\Controllers\front\firma\indexController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [App\Http\Controllers\front\firma\indexController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}', [App\Http\Controllers\front\firma\indexController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [App\Http\Controllers\front\firma\indexController::class, 'delete'])->name('delete');
            Route::post('/data', [App\Http\Controllers\front\firma\indexController::class, 'data'])->name('data');
            Route::post('/recordData/{id}', [App\Http\Controllers\front\firma\indexController::class, 'recordData'])->name('recordData');
            Route::get('/detail/{id}', [App\Http\Controllers\front\firma\indexController::class, 'detail'])->name('detail');
            Route::get('/change', [App\Http\Controllers\front\firma\indexController::class, 'change'])->name('change');
            Route::get('/mailTester', [App\Http\Controllers\front\firma\indexController::class, 'mailTest'])->name('mailTest');
    });

    Route::group(['namespace' => 'offerList', 'as' => 'offerList.','prefix' => 'offerList','middleware' => ['CheckOfferId']], function () {
        Route::get('/', [App\Http\Controllers\front\offerList\indexController::class, 'index'])->name('index');
        Route::post('/data', [App\Http\Controllers\front\offerList\indexController::class, 'data'])->name('data');
        Route::post('/data2', [App\Http\Controllers\front\offerList\indexController::class, 'data2'])->name('data2');
        Route::post('/statusChanger/{id}/{type}', [App\Http\Controllers\front\offerList\indexController::class, 'statusChanger'])->name('statusChanger');
        Route::post('/cancelOffer/{id}/{type}', [App\Http\Controllers\front\offerList\indexController::class, 'cancelOffer'])->name('cancelOffer');
        Route::get('/detail/{id}/{type}', [App\Http\Controllers\front\offerList\indexController::class, 'detail'])->name('detail');
        Route::get('/kunden', [App\Http\Controllers\front\offerList\indexController::class, 'kunden'])->name('kunden');
    });

    Route::group(['namespace' => 'firmaUser', 'as' => 'firmaUser.','prefix' => 'firmaUser','middleware' => ['CheckUser']], function () {
        Route::get('/edit/{id}', [App\Http\Controllers\front\firmaUser\indexController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [App\Http\Controllers\front\firmaUser\indexController::class, 'update'])->name('update');
        Route::get('/detail/{id}/{type}', [App\Http\Controllers\front\firmaUser\indexController::class, 'detail'])->name('detail');
    });
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


