<?php

use App\Http\Controllers\Api\DepartmentController;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('departments')->name('departments.')->group(function() {
    Route::get('/', [DepartmentController::class, 'index'])->name('index');
    Route::get('/{department}', [DepartmentController::class, 'detail'])->name('detail');
    Route::post('/create', [DepartmentController::class, 'create'])->name('create');
    Route::put('/{department}', [DepartmentController::class, 'update'])->name('update-put');
    Route::patch('/{department}', [DepartmentController::class, 'update'])->name('update-patch');
    Route::delete('/{department}', [DepartmentController::class, 'delete'])->name('delete');
});
