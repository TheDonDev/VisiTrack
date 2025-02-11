<?php

namespace App\Http\Controllers;

use App\Models\Host;
use App\Models\Visit;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VisitController extends Controller
{
    public function bookVisit(Request $request)
    {
        $visit = new Visit();
        $visit->visit_number = uniqid('visit_'); // Generate a unique visit number
        $visit->visitor_name = $request->input('visitor_name');
        $visit->visitor_email = $request->input('visitor_email');
        $visit->visitor_number = $request->input('visitor_number');
        $visit->host_id = $request->input('host_id');
        $visit->status = 'booked';
        $visit->purpose_of_visit = $request->input('purpose_of_visit');
        $visit->visit_facility = $request->input('visit_facility');
        $visit->visit_type = $request->input('visit_type');
        $visit->visit_date = $request->input('visit_date');
        $visit->visit_from = $request->input('visit_from');
        $visit->visit_to = $request->input('visit_to');
        $visit->save();

        // Send email notifications
        Mail::to($visit->visitor_email)->send(new \App\Mail\VisitBooked($visit));
        $host = Host::find($visit->host_id);
        Mail::to($host->host_email)->send(new \App\Mail\VisitBooked($visit));

        return response()->json(['message' => 'Visit booked successfully', 'visit_number' => $visit->visit_number]);
    }

    public function joinVisit(Request $request)
    {
        $request->validate([
            'visit_number' => 'required|string',
            'visitor_name' => 'required|string',
            'visitor_email' => 'required|email',
            'visitor_number' => 'required|string',
        ]);

        $visit = Visit::where('visit_number', $request->input('visit_number'))->first();

        if (!$visit) {
            return response()->json(['message' => 'Visit not found'], 404);
        }

        // Logic to save joining visitor details
        $joiningVisitor = new Visit();
        $joiningVisitor->visit_number = $visit->visit_number; // Use the same visit number
        $joiningVisitor->visitor_name = $request->input('visitor_name');
        $joiningVisitor->visitor_email = $request->input('visitor_email');
        $joiningVisitor->visitor_number = $request->input('visitor_number');
        $joiningVisitor->host_id = $visit->host_id; // Use the same host
        $joiningVisitor->status = 'joined';
        $joiningVisitor->save();

        // Notify the host and original visitor
        Mail::to($visit->host->host_email)->send(new \App\Mail\VisitorJoined($joiningVisitor));

        return response()->json(['message' => 'Successfully joined the visit', 'visit_number' => $visit->visit_number]);
    }
        public function checkIn(Request $request)
    {
        $request->validate([
            'visit_number' => 'required|string',
            'visitor_name' => 'required|string',
        ]);

        $visit = Visit::where('visit_number', $request->input('visit_number'))->first();

        if (!$visit) {
            return response()->json(['message' => 'Visit not found'], 404);
        }

        // Logic for check-in
        $visit->status = 'checked_in';
        $visit->save();

        return response()->json(['message' => 'Checked in successfully', 'visit_number' => $visit->visit_number]);
    }

    public function showBookVisitForm()
    {
        return view('book-visit'); // Return the book visit view
    }

    public function showJoinVisitForm()
    {
        return view('join-visit'); // Return the join visit view
    }

    public function index()
    {
        return view('index'); // Return the index view
    }

    public function notifyHost(Request $request)
    {
        $request->validate([
            'visit_number' => 'required|string',
        ]);

        $visit = Visit::where('visit_number', $request->input('visit_number'))->first();

        if (!$visit) {
            return response()->json(['message' => 'Visit not found'], 404);
        }

        // Notify the host
        Mail::to($visit->host->host_email)->send(new \App\Mail\VisitorCheckedIn($visit));

        return response()->json(['message' => 'Host notified successfully']);
    }

    public function visitStatus($visitNumber)
    {
        $visit = Visit::where('visit_number', $visitNumber)->first();

        if (!$visit) {
            return response()->json(['message' => 'Visit not found'], 404);
        }

        return response()->json(['visit' => $visit]);
    }
}
