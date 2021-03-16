<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/wallet', [App\Http\Controllers\WalletController::class, 'showBalance'])->name('showBalance');
Route::get('/editBalance', [App\Http\Controllers\WalletController::class, 'editBalance'])->name('editBalance');
Route::post('/updateBalance', [App\Http\Controllers\WalletController::class, 'updateBalance'])->name('updateBalance');

Route::get('/showDeposits', [App\Http\Controllers\DepositController::class, 'index'])->name('showDeposits');
Route::get('/createDeposit', [App\Http\Controllers\DepositController::class, 'createDeposit'])->name('createDeposit');
Route::post('/saveDeposit', [App\Http\Controllers\DepositController::class, 'saveDeposit'])->name('saveDeposit');

Route::get('/showTransactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('showTransactions');
