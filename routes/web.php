<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(["auth","verified"])->group(function(){
    Route::get("/movies",[MovieController::class,"index"])->name("movies.index");
    Route::get("/movies/create",[MovieController::class,"create"])->name("movies.create");
    Route::post("/movies/post",[MovieController::class,"post"])->name("movies.post");


});
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
