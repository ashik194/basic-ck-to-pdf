<?php

use App\Http\Controllers\ContentCreateController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get("/content", [ContentCreateController::class, 'content_create']);
Route::post("/content", [ContentCreateController::class, 'content_store'])->name("content_store");
Route::post("/upload", [ContentCreateController::class, 'imageupload'])->name("ckeditor.upload");

Route::get("/content/show/{id}", [ContentCreateController::class, 'content_show']);
// Route::get("/content/generate/{id}", [ContentCreateController::class, 'generate_pdf'])->name('generate');
Route::get("/content/generate/{id}", [ContentCreateController::class, 'mpdf'])->name('generate');
Route::get("/all-content", [ContentCreateController::class, 'all_PDF']);

require __DIR__.'/auth.php';
