<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentWebController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/welcome', function () {
//     return view('welcome');
// })->name('welcome');




// Route::get('hello', function () {
//    return view('hello');
// })->name('hello');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('residents', ResidentWebController::class);
Route::post('/residents/{id}/toggle-status', [ResidentWebController::class, 'toggleStatus'])->name('residents.toggleStatus');;

Route::post('/residents/{id}/', [ResidentWebController::class, 'toggleStatus'])->name('residents.toggleStatus');;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

//Route::post('/residents/{id}/toggle-status', [ResidentWebController::class, 'toggleStatus'])->name('residents.toggleStatus');;


require __DIR__.'/auth.php';
