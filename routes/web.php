<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/listing', function () {
    return Inertia::render('Listing');
})->middleware(['auth', 'verified'])->name('listing');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/get/listing', [ListingController::class, 'index'])->name('listing.index');
    Route::post('/listing', [ListingController::class, 'store'])->name('listing.store');
    Route::get('/edit/listing/{listings}', [ListingController::class, 'edit'])->name('listing.edit');
    Route::put('/listing/{listings}', [ListingController::class, 'update'])->name('listing.update');
    Route::delete('/listing/{listings}', [ListingController::class, 'destroy'])->name('listing.destroy');
});

require __DIR__.'/auth.php';
