<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/prueba', function () {
    return "la prueba";
})->name('prueba');

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::resource('presentations', App\Http\Controllers\PresentationController::class);
    Route::get('getslides/{presentationId}', [App\Http\Controllers\SlideController::class, 'getslides'])->name('getslides');
    Route::get('presentation.edit/{presentationId}', [App\Http\Controllers\PresentationController::class, 'edit'])->name('presentation.edit');
    



    //Route::resource('slides', App\Http\Controllers\SlideController::class);

    Route::get('slides.create/{presentationId}', [App\Http\Controllers\SlideController::class, 'create'])->name('slides.create');    
    Route::get('slides.index', [App\Http\Controllers\SlideController::class, 'index'])->name('slides.index');    
    Route::post('slides.store', [App\Http\Controllers\SlideController::class, 'store'])->name('slides.store');    
    Route::get('slides.edit/{slideId}', [App\Http\Controllers\SlideController::class, 'edit'])->name('slides.edit');    
    Route::put('slides.update', [App\Http\Controllers\SlideController::class, 'update'])->name('slides.update');    







    Route::get('camping', [App\Http\Controllers\PresentationController::class, 'camping'])->name('camping');

    

});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
