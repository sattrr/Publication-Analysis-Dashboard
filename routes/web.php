<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\AuthorController;

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
    return view('pages.dashboard');
});

Route::get('/home', function () {
    return view('pages.dashboard');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/publications', [PublicationController::class, 'index'])->name('publications');
Route::get('/authors', [AuthorController::class, 'index'])->name('authors');