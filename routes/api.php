<?php
use App\Http\Controllers\TaskController;

// List all todos
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

// Show a specific todo
Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');

// Create a new todo
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

// Update a todo
Route::put('/tasks/{title}', [TaskController::class, 'update'])->name('tasks.update');

// Delete a todo
Route::delete('/tasks/{id}', [TaskController::class, 'delete'])->name('tasks.delete');
