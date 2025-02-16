<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitController;

// Visitor check-in routes
Route::post('/check-in', [VisitController::class, 'checkIn'])->name('visits.check-in');
Route::post('/submit-feedback', [VisitController::class, 'submitFeedback'])->name('visits.submit-feedback');

// Visit management routes
Route::get('/', [VisitController::class, 'index'])->name('home');
Route::get('/book-visit', [VisitController::class, 'showBookVisitForm']);
Route::post('/book-visit', [VisitController::class, 'bookVisit'])->name('book.visit');
Route::get('/join-visit', [VisitController::class, 'showJoinVisitForm']);
Route::post('/join-visit', [VisitController::class, 'joinVisit'])->name('join.visit');
Route::post('/check-in', [VisitController::class, 'checkIn']);
Route::post('/notify-host', [VisitController::class, 'notifyHost']);

Route::get('/visit-status/{visitNumber}', [VisitController::class, 'visitStatus'])->name('visit.status');
Route::post('/feedback', [VisitController::class, 'submitFeedback'])->name('feedback');
