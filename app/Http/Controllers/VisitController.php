<?php

namespace App\Http\Controllers;

use App\Models\Visitor; // import the Visit model
use App\Models\Host;
use App\Models\Feedback; // Import the Feedback model
use App\Models\Visit; // Import the Visit model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // Import Log facade
use Illuminate\Support\Str; // Import Str facade
use App\Mail\VisitBooked;
use App\Mail\VisitorJoined;
use App\Mail\HostVisitNotification; // Import the new HostVisitNotification class

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

    // Create the visit record
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
    ]);

    // Retrieve host details
    $host = Host::find($request->host_id);
    if (!$host) {
        Log::error("Host not found for ID: " . $request->host_id);
        return redirect()->back()->withErrors(['host' => 'Host not found.']);
    }

    // Send email notifications to visitor and host
    Mail::to($validatedData['visitor_email'])->send(new VisitBooked([
        'visit' => $visit,
        'visitNumber' => $visitNumber,
        'host_name' => $host->name,
        'host_number' => $host->phone_number,
        'visitor_email' => $validatedData['visitor_email']
    ]));

    Mail::to($host->email)->send(new HostVisitNotification($validatedData, $visitNumber, $host));

    // Return success response
    return redirect()->route('index')->with('success', "Visit booked successfully! Your visit number is: $visitNumber")->with('visit_number', $visitNumber);
}


    public function joinVisit(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:15',
            'id_number' => 'required|string|max:20',
            'visit_number' => 'required|string',
        ]);

        // Find the visit by visit number
        $visit = Visitor::where('visit_number', $request->visit_number)->first();

        if (!$visit) {
            return redirect()->back()->withErrors(['visit_number' => 'Visit number not found.']);
        }

        // Save joining visitor details
        $joiningVisitor = Visitor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'designation' => $request->designation,
            'organization' => $request->organization,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'id_number' => $request->id_number,
            'visit_number' => $request->visit_number,
        ]);

        // Send email notifications
        Mail::to($visit->email)->send(new VisitorJoined($joiningVisitor->toArray(), $visit->visit_number));
        Mail::to($visit->host->email)->send(new HostVisitNotification($joiningVisitor->toArray(), $visit->visit_number, $visit->host));

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
            Mail::to($visit->host->email)->send(new VisitorJoined($visit, $visit->visit_number));
            return response()->json(['message' => 'Host has been notified!']);
        }
        return response()->json(['message' => 'Visit number not found.'], 404);
    }
}