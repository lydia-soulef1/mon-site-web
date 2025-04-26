<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ParentRegistrationController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/register', function () {
    return view('auth.register');
})->name('register');




Route::get('/register-parent', [ParentRegistrationController::class, 'showRegistrationForm'])->name('register.parent');
Route::post('/register-parent', [ParentRegistrationController::class, 'register']);
Route::get('/add-child', function() {
    // This route would go to the add child page
})->name('add_child');

use App\Http\Controllers\PediatricianRegistrationController;

Route::post('/register/medecin', [PediatricianRegistrationController::class, 'register']);

Route::get('/register/medecin', [PediatricianRegistrationController::class, 'showForm'])->name('register.medecin');


use App\Http\Controllers\DashboardController;


// Protect the dashboard routes with authentication middleware
// Example routes for dashboards
Route::get('/meddash', [DashboardController::class, 'pediatricianDashboard'])->name('meddash');
Route::get('/pardash', [DashboardController::class, 'parentDashboard'])->name('pardash');

use App\Http\Controllers\ChildController;

Route::post('/children', [ChildController::class, 'store'])->name('child.store');



Route::get('/calendar/child/{child_id}', [ChildController::class, 'showCalendar'])->name('calendar.child');
