<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DashboardController;

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



Route::get('/', [DashboardController::class, 'index']);
// Route::get('/', function () {
//     return redirect()->route('patients.index'); 
// });

Route::resource('patients', PatientController::class);
Route::get('/grafik', [App\Http\Controllers\DashboardController::class, 'grafik'])->name('grafik');
Route::get('/patients/{id}/pdf', [App\Http\Controllers\PatientController::class, 'exportPDF'])->name('patients.pdf');
