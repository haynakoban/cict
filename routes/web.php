<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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

Route::get('/home', function () {
    return view('welcome');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin',                    'index')->name('index'); // show all faculties and attendance checkers
    Route::get('/admin/register',           'create')->name('admin.create'); // show register form
    Route::get('/admin/login',              'login')->name('admin.login'); // show login form
    Route::post('/admin',                   'register')->name('admin.register'); // create new admin
    Route::post('/admin/authenticate',      'authenticate')->name('admin.authenticate'); // admin log in
    Route::post('/admin/logout',            'logout')->name('admin.logout'); // admin log out
});

Route::controller(UserController::class)->group(function () {
    Route::get('/',                         'index')->name('index'); // show all faculties and attendance checkers
    Route::get('/register',                 'create')->name('create'); // show register form
    Route::get('/login',                    'login')->name('login'); // show login form
    Route::post('/',                        'register')->name('register'); // create new user
    Route::post('/authenticate',            'authenticate')->name('authenticate'); // user log in
    Route::post('/logout',                  'logout')->name('logout'); // user log out
});


