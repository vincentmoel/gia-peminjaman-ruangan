<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[RentController::class,'index']);
Route::resource('rents', RentController::class);
Route::resource('rooms', RoomController::class);
Route::resource('divisions', DivisionController::class)->except('show','create');
Route::resource('departments', DepartmentController::class)->except('show','create');