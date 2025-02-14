<?php

namespace App\Http\Controllers;

use App\Models\Host;
use App\Models\Visit;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // Import Log facade

class VisitController extends Controller
{
    public static function generateVisitNumber()
    {
        return 'VN-' . strtoupper(uniqid());
    }

    public function bookVisit(Request $request)
    {
        try {
            $request->validate([
                'visitor_name' => 'required|string|max:255',
                'visitor_last_name' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'organization' => 'required|string|max:255',
                'visitor_email' => 'required|email|max:255',
                'visit_number' => 'required|string|max:20',
                'id_number' => 'required|string|max:50',
                'visit_type' => 'required|string',
                'visit_facility' => 'required|string',
                'visit_date' => 'required|date',
                'visit_from' => 'required|date_format:H:i',
                'visit_to' => 'required|date_format:H:i',
                'purpose_of_visit' => 'required|string',
                'host_id' => 'required|exists:hosts,id',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ' . json_encode($e->errors()));
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $visitData = $request->all();
        $visitData['visit_number'] = self::generateVisitNumber(); // Generate visit number
        $visit = Visit::create($visitData);

        // Send email to host and visitor
        Mail::to($visit->visitor_email)->send(new \App\Mail\VisitBooked($visit));
        Mail::to(Host::find($visit->host_id)->email)->send(new \App\Mail\VisitBooked($visit));

        return redirect()->route('home')
            ->with('success', 'Visit booked successfully!')
            ->with('visit_number', $visit->visit_number);
    }

    // Other methods remain unchanged...

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
        $hosts = Host::all(); // Fetch all hosts
        return view('book-visit', compact('hosts')); // Pass hosts to the view
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