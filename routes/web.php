<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::resource('presentations', App\Http\Controllers\PresentationController::class);
    Route::get('getslides/{presentationId}', [App\Http\Controllers\SlideController::class, 'getslides'])->name('getslides');



    Route::resource('slides', App\Http\Controllers\SlideController::class);

    Route::get('slides.create/{presentationId}', [App\Http\Controllers\SlideController::class, 'create'])->name('slides.create');    


    Route::get('camping', [App\Http\Controllers\PresentationController::class, 'camping'])->name('camping');

    

});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
