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

// Route::get('/admin', [AdminController::class, 'index'])->name('admin.index'); // show all faculties and attendance checkers
// Route::get('/admin/schedules', [AdminController::class, 'indexSchedule'])->name('admin.createSchedule'); // show all schedule
// Route::get('/admin/keys', [AdminController::class, 'keys'])->name('admin.keys'); // show all rooms/keys available
// Route::post('/admin/keys',[AdminController::class, 'createKey'])->name('admin.createKey'); // create new key
// Route::get('/admin/keys/history', [AdminController::class, 'history'])->name('admin.history'); // show key history

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin',                                'index')->name('index'); // show all faculties and attendance checkers
    Route::get('/admin/keys',                           'keys')->name('admin.keys'); // show all rooms/keys available
    Route::post('/admin/keys',                          'createKey')->name('admin.createKey'); // show all rooms/keys available
    Route::get('/admin/keys/history',                   'history')->name('admin.history'); // show key history
    Route::get('/admin/keys/{id}',                      'key')->name('admin.key'); // show room/key details
    
    Route::get('/admin/schedules',                      'indexSchedule')->name('admin.createSchedule'); // show all schedule
    Route::get('/admin/schedules/create',               'createSchedule')->name('admin.createSchedule'); // show schedule form
    Route::post('/admin/schedules',                     'storeSchedule')->name('admin.storeSchedule'); // create new schedule
    Route::get('/admin/schedules/{id}',                 'showSchedule')->name('admin.showSchedule'); // show single schedule
    
    Route::post('/admin',                               'register')->name('admin.register'); // create new admin
    Route::get('/admin/register',                       'create')->name('admin.create'); // show register form
    Route::get('/admin/login',                          'login')->name('admin.login'); // show login form
    Route::post('/admin/authenticate',                  'authenticate')->name('admin.authenticate'); // admin log in
    Route::post('/admin/logout',                        'logout')->name('admin.logout'); // admin log out
}); 

Route::controller(UserController::class)->group(function () {
    Route::get('/',                             'index')->name('index'); // show all faculties and attendance checkers
    Route::get('/register',                     'create')->name('create'); // show register form
    Route::get('/login',                        'login')->name('login'); // show login form
    Route::post('/',                            'register')->name('register'); // create new user
    Route::post('/authenticate',                'authenticate')->name('authenticate'); // user log in
    Route::post('/logout',                      'logout')->name('logout'); // user log out
});

// Route::controller(FacultyController::class)->group(function () {
//     Route::get('/faculty/attendances',          'index')->name('index'); // show all faculties, rooms and attendances for the logged in user
//     Route::get('/faculty/attendances/{id}',     'show')->name('show'); // show individual faculties, rooms and attendances
// });

// Route::controller(AttendanceCheckerController::class)->group(function () {
//     Route::get('/checker/attendances',          'index')->name('index'); // show all faculties, rooms and attendances for the logged in user
//     Route::get('/checker/attendances/{id}',     'show')->name('show'); // show individual faculties, rooms and attendances
//     Route::put('/checker/attendances/{id}',     'update')->name('update'); // show individual faculties, rooms and attendances
// });