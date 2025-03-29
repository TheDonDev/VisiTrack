<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\VisitController;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\FeedController;


Route::post('/check-in', [VisitController::class, 'checkIn'])->name('visits.check-in.submit');
Route::get('/', function () {
    $visitNumber = session('visit_number', null);
    return view('index', compact('visitNumber'));
})->name('index');

// Book Visit Routes
Route::get('/book-visit', [VisitController::class, 'showBookVisitForm'])->name('book.visit');
Route::post('/book-visit', [VisitController::class, 'bookVisit'])->name('book.visit.submit');

// Join Visit Routes
Route::get('/join-visit', function () {
    return view('join-visit');
})->name('join.visit');
Route::post('/join-visit', [VisitController::class, 'joinVisit'])->name('join.visit.submit');


Auth::routes(['verify' => true]); // Enable email verification routes

// Adding the verification route
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/feedback', [VisitController::class, 'submitFeedback'])->name('feedback.submit');
Route::get('/login', function () {
    return view('security.login');
})->name('security.login');

Route::get('/signup', function () {
    return view('security.signup');
})->name('security.signup.submit');

Route::post('/login', [AuthController::class, 'login'])->name('security.login');
Route::post('/signup', [AuthController::class, 'signup'])->name('security.signup.submit');

// Visit Status Routes
Route::post('/check-status', [VisitController::class, 'showVisitStatus'])->name('visits.status');
Route::post('/process-check-in', [VisitController::class, 'processCheckIn'])->name('visits.process-check-in');