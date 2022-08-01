<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\HomeController;
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

Route::get('/',[HomeController::class,'index'])->middleware('revalidate');
Route::post('/login',[AuthController::class,'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/logout', function () { return redirect('/'); });

Route::group(['middleware' => ['guest', 'revalidate']], function () {
    Route::get('/login',[AuthController::class,'index'])->name('login');
    
});


Route::group(['middleware' => ['auth', 'revalidate']], function () {
    Route::post('/rents/check-availability/',[RentController::class,'checkAvailabilitySchedule']);
    Route::resource('rents', RentController::class)->except('show','create');
    Route::resource('rooms', RoomController::class)->except('show','create');
    Route::resource('divisions', DivisionController::class)->except('show','create');
    Route::resource('departments', DepartmentController::class)->except('show','create');
});


Route::get('/date',[HomeController::class,'date']);
Route::get('/schedules',[RentController::class,'schedules']);
Route::post('/schedules-refresh',[RentController::class,'schedules_refresh']);


    