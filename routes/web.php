<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\StatsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;

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
Route::get('/', [HomeController::class, 'index']);
Route::get('/user/{name}', [UserController::class, 'show']);
Route::get('/about', function () { return view('pages.about'); })->name('about');
Route::redirect('/log-in', '/login');

Route::middleware('auth')->group(function () {
Route::prefix('app')->group(function () {
Route::get('/dashboard', DashboardController::class)->name('dashboard');
Route::resource('/tasks', TaskController::class);
});

Route::middleware('is_admin')->prefix('admin')->group(function () {
Route::get('/dashboard', AdminDashboardController::class);
Route::get('/stats', StatsController::class);
});
});

require __DIR__.'/auth.php';

