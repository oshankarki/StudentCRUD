<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();
Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
Route::get('/user/profile/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('profile.edit');
Route::get('/changePassword', [App\Http\Controllers\UserController::class, 'changePassword'])->name('password.change');
Route::put('', [App\Http\Controllers\UserController::class, 'update'])->name('profile.update');
Route::put('/updatePassword', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.password.update');







Route::middleware('auth')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/create',[\App\Http\Controllers\StudentController::class,'create'])->name('student.create');
    Route:: post('',[\App\Http\Controllers\StudentController::class,'store'])->name('student.store');
    Route::get('/student',[\App\Http\Controllers\StudentController::class,'index'])->name('student.index');
    Route::delete('/student/{id}', [\App\Http\Controllers\StudentController::class,'destroy'])->name('student.destroy');
    Route:: get('/{id}/edit',[\App\Http\Controllers\StudentController::class,'edit'])->name('student.edit');
    Route:: put('/{id}',[\App\Http\Controllers\StudentController::class,'update'])->name('student.update');
    Route:: get('/{id}',[\App\Http\Controllers\StudentController::class,'show'])->name('student.show');
});
