<?php

use App\Http\Controllers\TodoController;
use App\Models\Todo;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});
Route::get('/home', [TodoController::class, 'index'])->name('home');
Route::post('/home', [TodoController::class, 'store'])->name('todo.post');
Route::delete('/home/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');
Route::put('/home/{id}/update', [TodoController::class, 'update'])->name('todo.update');
Route::put('/home/{id}/done', [TodoController::class, 'updateIsDone'])->name('todo.updateDone');


