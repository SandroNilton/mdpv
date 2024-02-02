<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RequirementController;
use App\Http\Controllers\Admin\TypeProcedureController;

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Web Routes - user
|--------------------------------------------------------------------------
*/

Route::middleware(['verified', 'auth', 'user-access:user'])->name('user.')->group(function (){
  Route::view('/', 'user.dashboard')->name('dashboard');



  Route::view('profile', 'user.profile')->name('profile');
});

/*
|--------------------------------------------------------------------------
| Web Routes - admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'user-access:admin'])->prefix('admin')->name('admin.')->group(function (){
  Route::view('/', 'admin.dashboard')->name('dashboard');

  Route::resource('areas', AreaController::class);
  Route::resource('categories', CategoryController::class);
  Route::resource('requirements', RequirementController::class);
  Route::resource('type-procedures', TypeProcedureController::class);

  Route::view('profile', 'admin.profile')->name('profile');
});
