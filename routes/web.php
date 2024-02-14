<?php

use App\Http\Controllers\PetController;
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

Route::fallback(function() {
    return redirect(route('pet.index'));
});


Route::prefix('pet')->group(function () {
    Route::get('/', [PetController::class, 'index'])->name('pet.index');

    Route::put('/create', [PetController::class, 'createPet'])->name('pet.create');
    Route::post('/find', [PetController::class, 'findPet'])->name('pet.find');
    Route::put('/edit', [PetController::class, 'editPet'])->name('pet.edit');
    Route::delete('/delete', [PetController::class, 'deletePet'])->name('pet.delete');
});
