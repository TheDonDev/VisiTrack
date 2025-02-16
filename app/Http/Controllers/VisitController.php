<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function showBookVisitForm()
    {
        return view('book-visit');
    }

    public function showJoinVisitForm()
    {
        return view('join-visit');
    }

    public function checkIn(Request $request)
    {
        $request->validate([
            'visit_number' => 'required|exists:visits,visit_number'
        ]);

        $visit = Visit::where('visit_number', $request->visit_number)->first();

        if ($visit->check_in_time) {
            return redirect()->back()->with('error', 'Visit already checked in');
        }

        $visit->update(['check_in_time' => now()]);

        return redirect()->back()->with('success', 'Check-in successful');
    }

    public function submitFeedback(Request $request)
    {
        $request->validate([
            'visit_number' => 'required|exists:visits,visit_number',
            'visitor_id' => 'required|exists:visitors,id',
            'comments' => 'required|string',
            'rating' => 'required|integer|between:1,5'
        ]);

        $visit = Visit::where('visit_number', $request->visit_number)->first();

        if ($visit->feedback) {
            return redirect()->back()->with('error', 'Feedback already submitted');
        }

        $visit->feedback()->create([
            'visitor_id' => $request->visitor_id,
            'visit_number' => $request->visit_number,
            'comments' => $request->comments,
            'rating' => $request->rating
        ]);

        return redirect()->back()->with('success', 'Feedback submitted successfully');
    }
}
