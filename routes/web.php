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

Route::post('/check-in', [VisitController::class, 'checkIn'])->name('visits.check-in.submit');
Route::get('/', function () {
    $visitNumber = session('visit_number', null);
    return view('index', compact('visitNumber'));
})->name('index');

Route::get('/book-visit', [VisitController::class, 'showBookVisitForm'])->name('book.visit');

Route::get('/join-visit', function () {
    return view('join-visit');
})->name('join.visit');

Route::post('/join-visit', [VisitController::class, 'joinVisit'])->name('join.visit.submit');

Route::post('/book-visit', [VisitController::class, 'bookVisit'])->name('book.visit.submit');

Route::get('/check-in', [VisitController::class, 'showCheckInForm'])->name('visits.check-in');
Route::post('/check-in', [VisitController::class, 'processCheckIn'])->name('visits.check-in.submit');

Route::get('/visit-status', [VisitController::class, 'showVisitStatus'])->name('visits.status');

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
})->name('security.signup');

Route::post('/login', [AuthController::class, 'login'])->name('security.login.submit');
Route::post('/signup', [AuthController::class, 'signup'])->name('security.signup.submit');
