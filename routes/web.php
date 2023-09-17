<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
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
    //unit
    Route::get('/addUnit', [UnitController::class, 'addUnit'])->name('addUnit');
    Route::post('/saveUnit', [UnitController::class, 'store'])->name('saveUnit');

    //department
    Route::get('/addDepartment', [DepartmentController::class, 'addDepartment'])->name('addDepartment');
    Route::post('/saveDepartment', [DepartmentController::class, 'store'])->name('saveDepartment');

    //brand
    Route::get('/addBrand', [BrandController::class, 'addBrand'])->name('addBrand');
    Route::post('/saveBrand', [BrandController::class, 'store'])->name('saveBrand');

    //category
    Route::get('/addCategory', [CategoryController::class, 'addCategory'])->name('addCategory');
    Route::post('/saveCategory', [CategoryController::class, 'store'])->name('saveCategory');

    //category
    Route::get('/addProduct', [ProductController::class, 'addProduct'])->name('addProduct');
    Route::post('/saveProduct', [ProductController::class, 'store'])->name('saveProduct');

    //stock
    Route::get('/addStock', [StockController::class, 'create'])->name('addStock');
    Route::post('/saveStock', [StockController::class, 'saveStore'])->name('saveStock');
    Route::get('/skucode', [StockController::class, 'skucode'])->name('skucode');

    Route::get('/currentstock', [StockController::class, 'show'])->name('currentstock');

    //sale
    Route::get('/newSale', [SaleController::class, 'create'])->name('newSale');
    Route::post('/saveSale', [SaleController::class, 'saveSale'])->name('saveSale');
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
