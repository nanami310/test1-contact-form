<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth')->group(function () {
    Route::get('/admin', [ContactController::class, 'getContacts'])->name('admin.contacts'); // コンタクト一覧を表示
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('/contact/{id}', [ContactController::class, 'show'])->name('contact.details');
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');