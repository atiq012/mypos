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

Route::get('/', function () {
    return view('welcome'); 
});


Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('is-auth', function () {
        $auth = Auth::user();
        return $auth;
    });

    Route::get('/category', function () {
        return view('categories');
    });

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('create/category',function(){
        return view('admin.category');
    });

});
require __DIR__.'/auth.php';
