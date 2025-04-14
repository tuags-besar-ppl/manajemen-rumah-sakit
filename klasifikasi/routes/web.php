<?php

use App\Http\Controllers\PeralatanController;
use Illuminate\Support\Facades\Route;

// Route for displaying the list of all equipment
Route::get('peralatan', [PeralatanController::class, 'index'])->name('peralatan.index');

// Route for showing the form to create new equipment
Route::get('peralatan/create', [PeralatanController::class, 'create'])->name('peralatan.create');

// Route for storing new equipment in the database
Route::post('peralatan', [PeralatanController::class, 'store'])->name('peralatan.store');

// Route for showing the form to edit equipment
Route::get('peralatan/{id}/edit', [PeralatanController::class, 'edit'])->name('peralatan.edit');

// Route for updating the equipment data in the database
Route::put('peralatan/{id}', [PeralatanController::class, 'update'])->name('peralatan.update');

// Route for deleting equipment
Route::delete('peralatan/{id}', [PeralatanController::class, 'destroy'])->name('peralatan.destroy');
