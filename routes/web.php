<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\VisitController;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth\AuthController;

// Test email route
Route::get('/send-test-email', function () {
    try {
        Mail::to('donaldmwanga33@gmail.com')->send(new TestMail());
        return 'Test email sent!';
    } catch (\Exception $e) {
        Log::error('Error sending test email: ' . $e->getMessage());
        return 'Failed to send test email.';
    }
});

// Main routes
Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/book-visit', [VisitController::class, 'showBookVisitForm'])->name('book.visit');

Route::get('/join-visit', function () {
    return view('join-visit');
})->name('join.visit');

Route::post('/join-visit', [VisitController::class, 'joinVisit'])->name('join.visit.submit');

Route::post('/book-visit', [VisitController::class, 'bookVisit'])->name('book.visit.submit');

Route::get('/check-in', [VisitController::class, 'showCheckInForm'])->name('visits.check-in');
Route::post('/check-in', [VisitController::class, 'processCheckIn'])->name('visits.check-in.submit');

Route::get('/visit-status/{visit}', [VisitController::class, 'showVisitStatus'])->name('visit.status');

Route::post('/submit-feedback', [VisitController::class, 'submitFeedback'])->name('visits.feedback.submit');

// Security routes
Route::get('/login', function () {
    return view('security.login');
})->name('security.login');

Route::get('/signup', function () {
    return view('security.signup');
})->name('security.signup');

Route::post('/login', [AuthController::class, 'login'])->name('security.login.submit');
Route::post('/signup', [AuthController::class, 'signup'])->name('security.signup.submit');