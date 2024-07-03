<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// routes related to users
Route::get('/api/users', [UserController::class, 'index']);
Route::post('/api/users', [UserController::class, 'store']);
Route::patch('/api/users/{user}/change-role', [UserController::class, 'changeRole']);
Route::put('/api/users/{user}', [UserController::class, 'update']);
Route::delete('/api/users/{user}', [UserController::class, 'destroy']);
Route::delete('/api/users', [UserController::class, 'bulkDelete']);

// appointments routes
Route::get('/api/appointments', [AppointmentController::class, 'index']);
Route::get('/api/appointments/status', [AppointmentController::class, 'getStatusWithCount']);
Route::post('/api/appointments/store', [AppointmentController::class, 'store']);
Route::get('/api/appointments/{appointment}/edit', [AppointmentController::class, 'edit']);
Route::put('/api/appointments/{appointment}/update', [AppointmentController::class, 'update']);
Route::delete('/api/appointments/{appointment}', [AppointmentController::class, 'destroy']);

// dashboard routes
Route::get('/api/stats/appointments', [DashboardController::class, 'appointmentsCount']);
Route::get('/api/stats/users', [DashboardController::class, 'usersCount']);

// client routes
Route::get('/api/clients', [ClientController::class, 'index']);
// adding a condition to take anything as url and load the default view welcome.blade.php & this route must be at the end always
Route::get('{view}', ApplicationController::class)->where('view', '(.*)');
