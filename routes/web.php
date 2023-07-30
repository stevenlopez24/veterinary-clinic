<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\Detail_history;

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
    return view('auth.login');
});

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('management/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');



Route::get('management/pets', [App\Http\Controllers\PetController::class, 'index'])->name('pets');
Route::get('/pets/{id}/distroy', [App\Http\Controllers\PetController::class, 'destroy'])->name('pet.delete');



Route::get('management/details_history', [App\Http\Controllers\Detail_historyController::class, 'index'])->name('detail_history');