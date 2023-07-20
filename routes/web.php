<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::view('/', 'auth.login');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('users/profile', 'UsersController@edit')->name('users.edit-profile');

Route::get('users/profile',  [App\Http\Controllers\profileController::class, 'edit_profile'])->name('users.edit-profile');
Route::put('users/profile', [App\Http\Controllers\profileController::class,'update_profile'])->name('users.update-profile');


Route::prefix('admin')->middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
   
    #fungsi data pegawai
    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::get('data-pegawai','index')->name('users.data-pegawai'); // Add this line
        Route::get('data-pegawai/create', 'create')->name('users.create');
        Route::post('data-pegawai', 'store')->name('users.store');
        Route::get('data-pegawai/{id}/edit', 'edit')->name('users.edit');
        Route::put('data-pegawai/{id}', 'update')->name('users.update');
        Route::post('data-pegawai/{id}','destroy')->name('users.destroy');
        Route::get('data-pegawai/sisa-cuti',  'resetSisaCuti')->name('users.sisa_cuti');
        Route::put('data-pegawai/reset-pass/{id}', 'resetPass')->name('users.reset_pass');
    });

    #fungsi aprove
    Route::controller(App\Http\Controllers\AproveController::class)->group(function () {
        Route::get('aprove', 'index')->name('aprove.index');
        Route::post('aprove/{id}/setuju', 'setuju')->name('aprove.setuju');
        Route::post('aprove/{id}/tolak', 'tolak')->name('aprove.tolak');

    });

    #fungsi ajukan cuti
    Route::controller(App\Http\Controllers\admin\AjuController::class)->group(function () {
        Route::get('ajucuti', 'index')->name('ajucutis.index');
        Route::get('ajucuti/create', 'create')->name('ajucutis.create');
        Route::post('ajucuti', 'store')->name('ajucutis.store');
        Route::get('ajucuti/{id}/edit', 'edit')->name('ajucutis.edit');
        Route::put('ajucuti/{id}', 'update')->name('ajucutis.update');
        Route::post('ajucuti/{id}','destroy')->name('ajucutis.destroy');
        });
    
});

Route::prefix('user')->middleware(['auth', 'checkRole:pegawai'])->group(function () {
    
    Route::controller(App\Http\Controllers\pegawai\cutiController::class)->group(function () {
    Route::get('ajucuti', 'index')->name('ajucuti.index');
    Route::get('ajucuti/create', 'create')->name('ajucuti.create');
    Route::post('ajucuti', 'store')->name('ajucuti.store');
    Route::get('ajucuti/{id}/edit', 'edit')->name('ajucuti.edit');
    Route::put('ajucuti/{id}', 'update')->name('ajucuti.update');
    Route::post('ajucuti/{id}','destroy')->name('ajucuti.destroy');
    });
    
    #fungsi mengganti profilewai\editprofileController::class, 'edit_profile'])->name('user.edit-profile');
    Route::put('user/profile', [App\Http\Controllers\pegawai\editprofileController::class,'update_profile'])->name('user.update-profile');
    
   
});