<?php

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

Route::get('/', function () {
    return view('dashboard');
})->name('home');

// Route::get('/officer', function () {
//     return view('officer');
// })->name('officer');

Route::get('/visitor', function () {
    return view('visitor');
})->name('visitor');

Route::get('/officer',[\App\Http\Controllers\officerController::class,'getOfficerDetails'])->name('officer');
Route::post('/insertOfficer',[\App\Http\Controllers\officerController::class,'insertOfficer'])->name('insertOfficer');