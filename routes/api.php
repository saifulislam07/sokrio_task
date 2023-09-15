<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UnitController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User register
Route::post('/auth/register', [UserController::class, 'createUser']);

// User login
Route::post('/auth/login', [UserController::class, 'loginUser']);

// Brand
Route::post('/add-brand', [BrandController::class, 'create']);
//category
Route::post('/add-category', [CategoryController::class, 'create']);
//department
Route::post('/add-department', [DepartmentController::class, 'create']);
//unit
Route::post('/add-unit', [UnitController::class, 'create']);

//product
Route::post('/add-product', [ProductController::class, 'create']);
Route::post('/add-stock', [StockController::class, 'store']);
Route::post('/add-sale', [SaleController::class, 'store']);
