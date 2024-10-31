<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\adminController;

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
Route::get('/', [ContactController::class, 'index'])->name('input.page');
Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');
Route::post('/contacts/clear', [ContactController::class, 'clearSession'])->name('contacts.clear');


Route::get('/register', [adminController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [adminController::class, 'register'])->name('register');

Route::get('/login', [adminController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [adminController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('admin'); 
    })->name('admin'); 
});