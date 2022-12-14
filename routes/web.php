<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//My Classes
use App\Http\Controllers\StudentController;

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

//MY ROUTES
Route::get('/dashboard',[StudentController::class,'viewDashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/create_student',[StudentController::class,'create'])->middleware(['auth','verified'])->name('student.create');
Route::post('/edit_student',[StudentController::class,'update'])->middleware(['auth','verified'])->name('student.edit');
Route::delete('/destroy/{id}/{image}',[StudentController::class,'destroy'])->middleware(['auth','verified'])->name('student.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
