<?php

use App\Http\Controllers\AnlaMovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AnlaMovieController::class, 'index']);
Route::prefix('movies')->name('movies.')->group(function () {
    Route::get('/data', [AnlaMovieController::class, 'data'])->name('data');
    Route::get('/create', [AnlaMovieController::class, 'create'])->name('create');
    Route::post('/store', [AnlaMovieController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [AnlaMovieController::class, 'form_edit'])->name('edit');
    Route::post('/{movie}/update', [AnlaMovieController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [AnlaMovieController::class, 'delete'])->name('delete');
});
Route::get('/movie/{id}', [AnlaMovieController::class, 'detail'])->name('movie.detail');
