<?php

use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\ExpenseCategoryController;
use App\Http\Controllers\Backend\ExpenseController;
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
    return redirect('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/updatepassword', [App\Http\Controllers\Backend\UserController::class, 'updatepassword'])->name('users.updatepassword');
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('expensecategories', ExpenseCategoryController::class);
Route::resource('expenses', ExpenseController::class);