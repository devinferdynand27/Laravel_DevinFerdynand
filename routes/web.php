<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MstrHospitalController;
use App\Http\Controllers\PasienController;
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
    return view('login');
});
Route::post('login-post', [AuthController::class, 'login']);
Route::get('logout-post', [AuthController::class, 'logout']);


Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class , 'dashboard']);
    Route::get('logout-post', [AuthController::class, 'logout']);
    Route::resource('/hospitals', MstrHospitalController::class)->names('hospital');
    Route::resource('/pasien', PasienController::class)->names('pasien');
    Route::post('/import/hospitals', [MstrHospitalController::class , 'import_hospitals']);
    Route::get('/export/hospitals', [MstrHospitalController::class , 'export_hospitals']);
});