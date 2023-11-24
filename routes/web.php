<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManageUsersController;
use App\Http\Middleware\CheckUserStatus;
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
})->middleware(['auth', 'verified','userStatus'])->name('dashboard');

Route::middleware(['auth', 'verified','userStatus'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profileImage', [ProfileController::class, 'addProfilePhoto'])->name('profile.addProfilePhoto');
    Route::get('/getAvatar', [ProfileController::class, 'getAvatar'])->name('getAvatar');
    Route::get('/getUsersList', [ManageUsersController::class, 'getUsersList'])->name('getUsersList');
    Route::post('/userHasRole', [ManageUsersController::class, 'userHasRole'])->name('userHasRole');
});

Route::get('/manageUsers', function () {
    return Inertia::render('ManageUsers');
})->middleware(['auth', 'verified','userStatus','role:Admin|MidLevelAdmin'])->name('manageUsers');

Route::middleware(['auth','role:Admin'])->group(function () {
    Route::post('/changeUserStatus', [ManageUsersController::class, 'changeUserStatus'])->name('changeUserStatus');
});

require __DIR__.'/auth.php';
