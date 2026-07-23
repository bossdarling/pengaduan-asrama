<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Student routes
Route::middleware(['auth', 'student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/complaints/create', [StudentController::class, 'createComplaint'])->name('create-complaint');
    Route::post('/complaints', [StudentController::class, 'storeComplaint'])->name('store-complaint');
    Route::get('/complaints', [StudentController::class, 'history'])->name('history');
    Route::get('/complaints/{id}', [StudentController::class, 'showComplaint'])->name('show-complaint');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/complaints', [AdminController::class, 'complaints'])->name('complaints');
    Route::get('/complaints/{id}', [AdminController::class, 'showComplaint'])->name('show-complaint');
    Route::put('/complaints/{id}', [AdminController::class, 'updateComplaintStatus'])->name('update-complaint');
    Route::get('/students', [AdminController::class, 'students'])->name('students');
    Route::post('/students/{id}/approve', [AdminController::class, 'approveStudent'])->name('approve-student');
    Route::delete('/students/{id}', [AdminController::class, 'rejectStudent'])->name('reject-student');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('/reports/pdf', [AdminController::class, 'generatePDF'])->name('generate-pdf');
});
