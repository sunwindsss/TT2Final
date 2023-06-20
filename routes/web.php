<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemporaryTVShowController;
use App\Http\Controllers\AdminPanelController;

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

// Search field route
Route::get('/tvshows/search', [TemporaryTVShowController::class, 'search'])->name('tvshows.search');

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

// Admin panel routes!!
Route::middleware('role:admin')->group(function () {
    // Routes accessible only to admin users
    // ADMIN PANEL ROUTE
    Route::get('/admin', [AdminPanelController::class, 'index'])->name('admin.admin');
    // Add TV Show routes
    Route::get('/admin/tvshow/create', [AdminPanelController::class, 'createTVShow'])->name('admin.tvshow.create');
    Route::post('/admin/tvshow', [AdminPanelController::class, 'storeTVShow'])->name('admin.tvshow.store');
    // Add Actor routes
    Route::get('/admin/actors/create', [AdminPanelController::class, 'createActor'])->name('admin.actor.create');
    Route::post('/admin/addactor', [AdminPanelController::class, 'storeActor'])->name('admin.actor.store');
    // Link actor to TV show route
    Route::get('/admin/linkactor', [AdminPanelController::class, 'linkActorView'])->name('admin.linkactor');
    Route::post('/admin/linkactor', [AdminPanelController::class, 'linkActor'])->name('admin.actor.link');
    // Delete TV show routes
    Route::get('/admin/tvshow/delete', [AdminPanelController::class, 'createDeleteTVShow'])
    ->name('admin.tvshow.delete.create');
    Route::post('/admin/tvshow/delete', [AdminPanelController::class, 'deleteTVShow'])
    ->name('admin.tvshow.delete');
    // Delete actor routes
    Route::get('/admin/actor/delete', [AdminPanelController::class, 'deleteActor'])->name('admin.actor.delete');
    Route::post('/admin/actor/destroy', [AdminPanelController::class, 'destroyActor'])->name('admin.actor.destroy');
    // Users list from admin panel
    Route::get('/admin/users', [AdminPanelController::class, 'showUsers'])->name('admin.users');
    Route::delete('/admin/users/{user}', [AdminPanelController::class, 'destroyUser'])->name('admin.user.destroy');
});
