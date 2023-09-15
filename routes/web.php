<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnitController;
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
    if (auth()->check()) return redirect('/dashboard');
    return view('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/addUnit', [UnitController::class, 'addUnit'])->name('addUnit');
    Route::post('/saveUnit', [UnitController::class, 'store'])->name('saveUnit');

    Route::get('/addDepartment', [DepartmentController::class, 'addDepartment'])->name('addDepartment');
    Route::post('/saveDepartment', [DepartmentController::class, 'store'])->name('saveDepartment');
});


Route::get('/dashboard', function () {
    return view('backend.pages.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
