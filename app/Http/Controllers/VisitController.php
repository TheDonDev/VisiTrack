<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Host;
use App\Models\Feedback;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Mail\VisitBooked;
use App\Mail\VisitorJoined;
use App\Mail\HostVisitNotification;
use App\Mail\VisitorCheckedIn;
use App\Mail\HostVisitorCheckedIn;

class VisitController extends Controller
{
    public function showBookVisitForm()
    {
        $hosts = Host::all();
        return view('book-visit', compact('hosts'));
    }

    public function bookVisit(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'visitor_name' => 'required|string',
            'visitor_last_name' => 'required|string',
            'designation' => 'required|string',
            'organization' => 'required|string',
            'visitor_email' => 'required|email',
            'visitor_number' => 'required|string',
            'id_number' => 'required|string',
            'visit_type' => 'required|string',
            'visit_facility' => 'required|string',
            'visit_date' => 'required|date',
            'visit_from' => 'required|date_format:H:i',
            'visit_to' => 'required|date_format:H:i',
            'purpose_of_visit' => 'required|string',
            'host_id' => 'required|exists:hosts,id',
        ]);

        // Generate a unique visit number
        $visitNumber = Visit::generateVisitNumber();

        // Find or create visitor
        $visitor = Visitor::findOrCreate($validatedData);

        // Create the visit record with eager loading
        $visit = Visit::create([
            'visit_number' => $visitNumber,
            'visitor_id' => $visitor->id,
            'host_id' => $validatedData['host_id'],
            'visit_type' => $validatedData['visit_type'],
            'visit_facility' => $validatedData['visit_facility'],
            'visit_date' => $validatedData['visit_date'],
            'visit_from' => $validatedData['visit_from'],
            'visit_to' => $validatedData['visit_to'],
            'purpose_of_visit' => $validatedData['purpose_of_visit'],
        ])->load('visitor');

        // Retrieve host details
        $host = Host::find($request->host_id);
        if (!$host) {
            Log::error("Host not found for ID: " . $request->host_id);
            return redirect()->back()->withErrors(['host' => 'Host not found.']);
        }
        Log::info("Retrieved host: " . $host->host_name . " with email: " . $host->host_email);
        // Log the email addresses being used
        Log::info("Visitor email: " . $validatedData['visitor_email']);
        Log::info("Host email: " . $host->host_email);
        if (empty($validatedData['visitor_email'])) {
            Log::error("Visitor email is empty.");
        }
        if (empty($host->host_email)) {
            Log::error("Host email is empty.");
            return redirect()->back()->withErrors(['host' => 'Host email is not set.']);
        }

        // Log the visit object and its properties
        Log::info("Visit object details: " . json_encode([
            'visit' => $visit->toArray(),
            'visitor_id' => $visit->visitor_id,
            'host_id' => $visit->host_id,
            'visit_number' => $visit->visit_number,
        ]));
        Log::info("Data being sent to VisitBooked email: " . json_encode([
            'visit' => $visit->toArray(),
            'visitNumber' => $visitNumber,
            'host_name' => $host->host_name,
            'host_email' => $host->host_email,
            'host_number' => $host->host_number,
        ]));
        Log::info("Visitor data being sent to VisitBooked email: ", [
            'visitor_name' => $visitor->visitor_name,
            'visitor_email' => $validatedData['visitor_email'],
            'visit_number' => $visitNumber,
        ]);

Log::info("Data being sent to VisitBooked email:", [
    'visitor_name' => $visitor->visitor_name,
    'visitor_email' => $validatedData['visitor_email'],
    'visit_number' => $visitNumber,
]);

Mail::to($validatedData['visitor_email'])->send(new VisitBooked([
            'visit' => $visit,
            'visitNumber' => $visitNumber,
            'host_name' => $host->host_name,
            'host_email' => $host->host_email,
            'host_number' => $host->host_number,
        ]));

        Mail::to($host->host_email)->send(new HostVisitNotification($validatedData, $visitNumber, $host));

        // Return success response
        return redirect()->route('index')->with('success', "Visit booked successfully! Your visit number is: $visitNumber .")->with('visit_number', $visitNumber);
    }

    public function joinVisit(Request $request)
    {
        $request->validate([
            'visitor_name' => 'required|string|max:255',
            'visitor_last_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'visitor_email' => 'required|email',
            'visitor_number' => 'required|string|max:15',
            'id_number' => 'required|string|max:20',
            'visit_number' => 'required|string',
        ]);

        // Find the visit by visit number
        $visit = Visit::where('visit_number', $request->visit_number)->first();

        if (!$visit) {
            return redirect()->back()->withErrors(['visit_number' => 'Visit number not found.']);
        }

        // Save joining visitor details
        $joiningVisitor = Visitor::create([
            'visitor_name' => $request->visitor_name,
            'visitor_last_name' => $request->visitor_last_name,
            'designation' => $request->designation,
            'organization' => $request->organization,
            'visitor_email' => $request->visitor_email,
            'visitor_number' => $request->visitor_number,
            'id_number' => $request->id_number,
            'visit_number' => $request->visit_number,
        ]);

        // Get the original visitor's email
        $originalVisitorEmail = $visit->visitor->visitor_email;

        // Send email notifications
        Mail::to($joiningVisitor->visitor_email)->send(new VisitorJoined($joiningVisitor->toArray(), $visit->visit_number));
        Mail::to($originalVisitorEmail)->send(new VisitorJoined([
            'message' => 'Someone has joined your visit',
            'joining_visitor' => $joiningVisitor->toArray()
        ], $visit->visit_number));
        Mail::to($visit->host->host_email)->send(new HostVisitNotification($joiningVisitor->toArray(), $visit->visit_number, $visit->host));

        // Return success response
        return redirect()->route('index')->with('success', "You have joined the visit successfully!");
    }

    public function submitFeedback(Request $request)
    {
        // Validate feedback data
        $request->validate([
            'visitor_id' => 'required|exists:visitors,id',
            'feedback' => 'required|string',
        ]);

        // Save feedback
        Feedback::create([
            'visitor_id' => $request->visitor_id,
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('index')->with('success', 'Feedback submitted successfully!');
    }

    public function notifyHost(Request $request)
    {
        // Logic to notify the host
        $visit = Visitor::where('visit_number', $request->visit_number)->first();
        if ($visit) {
            Mail::to($visit->host->host_email)->send(new VisitorJoined($visit, $visit->visit_number));
            return response()->json(['message' => 'Host has been notified!']);
        }
        return response()->json(['message' => 'Visit number not found.'], 404);
    }

    public function showCheckInForm()
    {
        return view('check-in');
    }

    public function processCheckIn(Request $request)
    {
        $request->validate([
            'visit_number' => 'required|string|exists:visits,visit_number'
        ]);

        // Find the visit
        $visit = Visit::where('visit_number', $request->visit_number)->first();

        if (!$visit) {
            return redirect()->back()->withErrors(['visit_number' => 'Visit number not found.']);
        }

        // Update visit status
        $visit->update(['status' => 'checked_in']);

        // Get related visitors
        $visitors = Visitor::where('visit_number', $visit->visit_number)->get();
        $totalVisitors = $visitors->count();

        // Retrieve the associated visitor
        $visitor = Visitor::where('visit_number', $visit->visit_number)->first();

        // Send notifications
        Mail::to($visit->visitor->visitor_email)->send(new VisitorCheckedIn($visit));
        Mail::to($visit->host->host_email)->send(new HostVisitorCheckedIn($visit));

        // Redirect to visit status page
        return redirect()->route('visits.status', ['visit' => $visit->id])
            ->with('success', 'Check-in successful!');
    }

    public function showVisitStatus($visit)
    {
$visit = Visit::with('host')->findOrFail($visit);
        $visitors = Visitor::where('visit_number', $visit->visit_number)->get();
        $totalVisitors = $visitors->count();
        Log::info("Visit data being passed to view:", [
            'visit' => $visit,
            'totalVisitors' => $totalVisitors,
            'visitors' => $visitors,
        ]);
        return view('visit-status', compact('visit', 'totalVisitors', 'visitors'));
    }
}
