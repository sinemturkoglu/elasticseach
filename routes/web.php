<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
 

Route::get('/', function () { return view('add');})->name('add.form');

Route::post('/save-form', [BlogController::class, 'store'])->name('form.store');
Route::get('/index', [BlogController::class, 'index'])->name('blogs.index');
Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
Route::get('/blogs/edit/{id}', [BlogController::class, 'edit'])->name('blogs.edit'); 
Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');

Route::get('/search', [BlogController::class, 'search'])->name('blogs.search');
Route::get('/elastic/search', [BlogController::class, 'elasticsearch'])->name('elastic.search');
 