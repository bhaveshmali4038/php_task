<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    // return view('welcome');
    return redirect()->route('user.index');
});


//User Routes

Route::prefix('user')->group(function () {
    Route::get('/',[UserController::class, 'index'])->name('user.index');
    Route::get('create',[UserController::class, 'create'])->name('user.create');
    Route::post('store',[UserController::class, 'store'])->name('user.store');
    Route::post('user-ajax',[UserController::class, 'userAjax'])->name('user.ajax');
    Route::get('{id}/edit',[UserController::class, 'edit'])->name('user.edit');
    Route::post('{id}/update',[UserController::class, 'update'])->name('user.update');
    Route::get('{id}/delete',[UserController::class, 'destroy'])->name('user.destroy');
    Route::get('status-ajax',[UserController::class, 'statusAjax'])->name('user.ajax_status_change');
});