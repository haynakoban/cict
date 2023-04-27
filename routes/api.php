<?php

use App\Http\Controllers\AdminController;
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

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index'); // show all faculties and attendance checkers
Route::get('/admin/schedules', [AdminController::class, 'indexSchedule'])->name('admin.createSchedule'); // show all schedule
Route::get('/admin/keys', [AdminController::class, 'keys'])->name('admin.keys'); // show all rooms/keys available
Route::get('/admin/keys/history', [AdminController::class, 'history'])->name('admin.history'); // show key history
