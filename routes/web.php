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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/create',[\App\Http\Controllers\StudentController::class,'create'])->name('student.create')->middleware('auth');
Route:: post('',[\App\Http\Controllers\StudentController::class,'store'])->name('student.store');
Route::get('',[\App\Http\Controllers\StudentController::class,'index'])->name('student.index');
Route::delete('/student/{id}', [\App\Http\Controllers\StudentController::class,'destroy'])->name('student.destroy')->middleware('auth');
Route:: get('/{id}/edit',[\App\Http\Controllers\StudentController::class,'edit'])->name('student.edit')->middleware('auth');
//route to update data
Route:: put('/{id}',[\App\Http\Controllers\StudentController::class,'update'])->name('student.update');
Route:: get('/{id}',[\App\Http\Controllers\StudentController::class,'show'])->name('student.show');

