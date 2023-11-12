<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';



Route::middleware(['auth', 'verified'])->group(function() {

    /** Profile Routes */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /** Timesheet Routes */
    Route::get('/getWorkday', [\App\Http\Controllers\TimesheetController::class, 'getWorkday']);
    Route::resource('timesheet', \App\Http\Controllers\TimesheetController::class);

    /** User Routes */
    Route::resource('user', \App\Http\Controllers\UserController::class)->middleware('can:create users');

    /** Client Routes */
    Route::resource('client', \App\Http\Controllers\ClientController::class)->middleware('can:create users');

    /** Project Routes */
    Route::resource('project', \App\Http\Controllers\ProjectController::class)->middleware('can:create users');

    /** Activity Routes */
    Route::resource('activity', \App\Http\Controllers\ActivityController::class)->middleware('can:create users');

    /** Chat Routes */
    Route::get('c/hat', [\App\Http\Controllers\MessageController::class, 'index'])->name('chat.index');
    Route::post('/chat', [\App\Http\Controllers\MessageController::class, 'store'])->name('chat.store');
    Route::get('/getChat', [\App\Http\Controllers\MessageController::class, 'getChat'])->name('chat.get');

    /** Report Routes */
    Route::get('/report', [\App\Http\Controllers\ReportController::class, 'index'])->name('report.index');
    Route::post('/report', [\App\Http\Controllers\ReportController::class, 'download'])->name('report.download');
});
