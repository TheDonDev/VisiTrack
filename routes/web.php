<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitController;



Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/book-visit', [VisitController::class, 'showBookVisitForm'])->name('book.visit');

Route::get('/join-visit', function () {
    return view('join-visit');
})->name('join.visit');

Route::post('/book-visit', [VisitController::class, 'bookVisit'])->name('book.visit.submit');

Route::get('/check-in', [VisitController::class, 'showCheckInForm'])->name('visits.check-in');
Route::post('/check-in', [VisitController::class, 'processCheckIn'])->name('visits.check-in.submit');

Route::get('/visit-status/{visit}', [VisitController::class, 'showVisitStatus'])->name('visits.status');

Route::post('/submit-feedback', [VisitController::class, 'submitFeedback'])->name('visits.feedback.submit');

Route::post('/notify-host', [VisitController::class, 'notifyHost'])->name('visits.notify-host');
