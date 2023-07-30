<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Detail_historyController;
use App\Http\Controllers\Medical_historyController;

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



Route::get('management/medical_history', [App\Http\Controllers\Medical_historyController::class, 'index'])->name('medical_history.index');
Route::get('management/medical_history/{m_h}', [App\Http\Controllers\Medical_historyController::class, 'show'])->name('medical_history.show');
Route::get('management/medical_history/{id}/distroy', [App\Http\Controllers\Medical_historyController::class, 'destroy'])->name('medical_history.delete');



Route::get('management/detail_history', [App\Http\Controllers\Detail_historyController::class, 'index'])->name('detail_history.index');
Route::get('management/detail_history/{deta}', [App\Http\Controllers\Detail_historyController::class, 'show'])->name('detail_history.show');
Route::get('management/detail_history/{id}/distroy', [App\Http\Controllers\Detail_historyController::class, 'destroy'])->name('detail_history.delete');