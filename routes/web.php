<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceCheckerController;

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

Route::get('/home', function () {
    return view('welcome');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin',                        'index')->name('index'); // show all faculties and attendance checkers
    Route::get('/admin/register',               'create')->name('admin.create'); // show register form
    Route::get('/admin/login',                  'login')->name('admin.login'); // show login form
    Route::get('/admin/attendances',                  'attendances')->name('admin.attendances'); // show all faculties, rooms and attendances
    Route::get('/admin/attendances/{id}',             'attendance')->name('admin.attendance'); // show individual faculties, rooms and attendances
    Route::get('/admin/keys',                         'keys')->name('admin.keys'); // show key history
    Route::get('/admin/keys/history',                 'history')->name('admin.history'); // show key history
    Route::get('/admin/schedules',                 'indexSchedule')->name('admin.createSchedule'); // show all schedule
    Route::get('/admin/schedules/create',                 'createSchedule')->name('admin.createSchedule'); // show schedule form
    Route::post('/admin/schedules',                 'storeSchedule')->name('admin.storeSchedule'); // create new schedule

    Route::post('/admin',                       'register')->name('admin.register'); // create new admin
    Route::post('/admin/authenticate',          'authenticate')->name('admin.authenticate'); // admin log in
    Route::post('/admin/logout',                'logout')->name('admin.logout'); // admin log out
}); 

Route::controller(UserController::class)->group(function () {
    Route::get('/',                             'index')->name('index'); // show all faculties and attendance checkers
    Route::get('/register',                     'create')->name('create'); // show register form
    Route::get('/login',                        'login')->name('login'); // show login form
    Route::post('/',                            'register')->name('register'); // create new user
    Route::post('/authenticate',                'authenticate')->name('authenticate'); // user log in
    Route::post('/logout',                      'logout')->name('logout'); // user log out
});

Route::controller(FacultyController::class)->group(function () {
    Route::get('/faculty/attendances',          'index')->name('index'); // show all faculties, rooms and attendances for the logged in user
    Route::get('/faculty/attendances/{id}',     'show')->name('show'); // show individual faculties, rooms and attendances
});

Route::controller(AttendanceCheckerController::class)->group(function () {
    Route::get('/checker/attendances',          'index')->name('index'); // show all faculties, rooms and attendances for the logged in user
    Route::get('/checker/attendances/{id}',     'show')->name('show'); // show individual faculties, rooms and attendances
    Route::put('/checker/attendances/{id}',     'update')->name('update'); // show individual faculties, rooms and attendances
});