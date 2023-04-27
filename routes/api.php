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

// Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\AdminController'], function () {
//     Route::get('/',                     'index')->name('index'); // show all faculties and attendance checkers
//     Route::post('/',                    'register')->name('admin.register'); // create new admin
//     Route::get('/register',             'create')->name('admin.create'); // show register form
//     Route::get('/login',                'login')->name('admin.login'); // show login form
//     Route::post('/authenticate',        'authenticate')->name('admin.authenticate'); // admin log in
//     Route::post('/logout',              'logout')->name('admin.logout'); // admin log out

//     Route::get('/keys',                 'keys')->name('admin.keys'); // show all rooms/keys available
//     Route::post('/keys',                'createKey')->name('admin.createKey'); // show all rooms/keys available
//     Route::get('/keys/history',         'history')->name('admin.history'); // show key history
//     Route::get('/keys/{id}',            'key')->name('admin.key'); // show room/key details
    
//     Route::get('/schedules',            'indexSchedule')->name('admin.createSchedule'); // show all schedule
//     Route::get('/schedules/create',     'createSchedule')->name('admin.createSchedule'); // show schedule form
//     Route::post('/schedules',           'storeSchedule')->name('admin.storeSchedule'); // create new schedule
//     Route::get('/schedules/{id}',       'showSchedule')->name('admin.showSchedule'); // show single schedule
// });