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

// Route::get('/visitor', function () {
//     return view('visitor');
// })->name('visitor');


// for Officer
Route::get('/officer',[\App\Http\Controllers\officerController::class,'getOfficersDetails'])->name('officer');
Route::post('/insertOfficer',[\App\Http\Controllers\officerController::class,'insertOfficer'])->name('insertOfficer');
Route::get('/getOfficerDetail/{id}',[\App\Http\Controllers\officerController::class,'getOfficerDetail'])->name('getOfficerDetail');
Route::put('/updateOfficer',[\App\Http\Controllers\officerController::class,'updateOfficer'])->name('updateOfficer');


// for Visitor
Route::get('/visitor',[\App\Http\Controllers\visitorController::class,'getVisitorsDetails'])->name('visitor');
Route::post('/insertVisitor',[\App\Http\Controllers\visitorController::class,'insertVisitor'])->name('insertVisitor');
Route::get('/getVisitorDetail/{id}',[\App\Http\Controllers\visitorController::class,'getVisitorDetail'])->name('getVisitorDetail');
Route::put('/updateVisitor',[\App\Http\Controllers\visitorController::class,'updateVisitor'])->name('updateVisitor');
