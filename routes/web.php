<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemporaryTVShowController;

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

/* Default welcome Laravel view (with login/register)
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [TemporaryTVShowController::class, 'index'])->name('home');

// Routes regarding to TV show ratings
Route::post('/tvshows/{tvshow}/rate', [TemporaryTVShowController::class, 'rate'])->name('tvshows.rate');
Route::delete('/tvshows/rate/{rating}', [TemporaryTVShowController::class, 'deleteRating'])->name('tvshows.rate.delete');

// Routes regarding to TV show watchlists
Route::post('/tvshows/{tvShow}/watchlist', [TemporaryTVShowController::class, 'addToWatchlist'])->name('watchlist.add');
Route::delete('/watchlist/{watchlist}', [TemporaryTVShowController::class, 'removeFromWatchlist'])->name('watchlist.remove');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// REDUNDANT: same as home route
Route::get('/temporary-tvshows', [TemporaryTVShowController::class, 'index'])->name('temporary-tvshows.index');
