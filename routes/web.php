<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\activityController;
use App\Http\Controllers\officerController;
use App\Http\Controllers\visitorController;

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


// for Officer
Route::get('/officer',[officerController::class,'getOfficersDetails'])->name('officer');
Route::post('/insertOfficer',[officerController::class,'insertOfficer'])->name('insertOfficer');
Route::get('/getOfficerDetail/{id}',[officerController::class,'getOfficerDetail'])->name('getOfficerDetail');
Route::get('/getAppointments/{id}',[officerController::class,'getAppointments'])->name('getAppointments');
Route::put('/updateOfficer',[officerController::class,'updateOfficer'])->name('updateOfficer');
Route::put('/updateOfficerStatus',[officerController::class,'updateOfficerStatus'])->name('updateOfficerStatus');

// for Visitor
Route::get('/visitor',[visitorController::class,'getVisitorsDetails'])->name('visitor');
Route::post('/insertVisitor',[visitorController::class,'insertVisitor'])->name('insertVisitor');
Route::get('/getVisitorDetail/{id}',[visitorController::class,'getVisitorDetail'])->name('getVisitorDetail');
Route::get('/getVisitorAppointments/{id}',[visitorController::class,'getVisitorAppointments'])->name('getVisitorAppointments');
Route::put('/updateVisitor',[visitorController::class,'updateVisitor'])->name('updateVisitor');
Route::put('/updateVisitorStatus',[visitorController::class,'updateVisitorStatus'])->name('updateVisitorStatus');

// for Activity
Route::get('/activity',[\App\Http\Controllers\activityController::class,'getActivitiesDetails'])->name('activity');
Route::post('/insertActivity',[activityController::class,'insertActivity'])->name('insertActivity');
Route::put('/updateActivity',[activityController::class,'updateActivity'])->name('updateActivity');
Route::put('/updateActivityStatus',[activityController::class,'updateActivityStatus'])->name('updateActivityStatus');
Route::put('/cancelActivity',[activityController::class,'cancelActivity'])->name('cancelActivity');
Route::get('/getActivityDetail/{id}',[activityController::class,'getActivityDetail'])->name('getActivityDetail');

