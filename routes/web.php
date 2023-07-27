<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\ContactController;
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

Route::controller( ContactController::class )->group( function(){
    // get index page
    Route::get('/','index')->name('home');
    Route::post('/contact','show')->name('display');
    Route::post('/contact/update','update')->name('update');
    Route::post('/contact/delete','delete')->name('delete');
    Route::post('/create-contact','create')->name('create-contact');

});

