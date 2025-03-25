<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Host;
use App\Models\Feedback;
use App\Models\Visit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Mail\VisitBooked;
use App\Mail\VisitorJoined;
use App\Mail\HostVisitNotification;
use App\Mail\HostVisitJoined; // Import the new mailable
use App\Mail\VisitorCheckedIn;
use App\Mail\HostVisitorCheckedIn;

class VisitController extends Controller
{
    public function showLoginForm()
    {
        return view('security.login');
    }

    public function showSignupForm()
    {
        return view('security.signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // Send confirmation email
        $visit = Visit::where('visitor_id', $user->id)->first();
        Mail::to($user->email)->send(new VisitorJoined($user, $visit));

        return redirect()->route('security.login')->with('success', 'Signup successful! Please log in.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (\Illuminate\Support\Facades\Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('visits.check-in')->with('success', 'Login successful!');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function showBookVisitForm()
    {
        $hosts = Host::all();
        return view('book-visit', compact('hosts'));
    }

    public function bookVisit(Request $request)
    {
        // Log the request data for debugging
        Log::info("Booking visit with data: ", $request->all());
        // Generate a unique visit number
        $visitNumber = Visit::generateVisitNumber();
        Log::info("Generated visit number: " . $visitNumber);

        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'designation' => 'required|string',
            'organization' => 'required|string',
            'id_number' => 'required|string',
            'visit_type' => 'required|string',
            'visit_facility' => 'required|string',
            'visit_date' => 'required|date',
            'visit_from' => 'required|date_format:H:i',
            'visit_to' => 'required|date_format:H:i',
            'purpose_of_visit' => 'required|string',
            'host_id' => 'required|exists:hosts,id',
        ]);

        // Create the visitor directly
        $visitor = Visitor::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'designation' => $validatedData['designation'],
            'organization' => $validatedData['organization'],
            'id_number' => $validatedData['id_number'],
        ]);

        // Save the visitor
        if (!$visitor->save()) {
            Log::error('Failed to save visitor', ['visit_number' => $visitNumber]);
            return redirect()->back()->withErrors(['error' => 'Failed to save visitor information. Please try again.']);
        }

        // Create the visit record
        $visit = Visit::create([
            'visit_number' => $visitNumber,
            'visitor_id' => $visitor->id, // Foreign key to the visitor
            'host_id' => $validatedData['host_id'],
            'visit_type' => $validatedData['visit_type'],
            'visit_facility' => $validatedData['visit_facility'],
            'visit_date' => $validatedData['visit_date'],
            'visit_from' => $validatedData['visit_from'],
            'visit_to' => $validatedData['visit_to'],
            'purpose_of_visit' => $validatedData['purpose_of_visit'],
        ]);

        // Associate the visitor with the visit
        $visit->visitors()->attach($visitor->id);

        // Log the visit number and set it in the session
        Log::info("Setting visit number in session: " . $visitNumber);
        session(['visit_number' => $visitNumber]);
        Log::info("Current session data: ", session()->all());

        // Prepare data for the email
        $emailData = [
            'visit' => $visit,
            'visitor' => $visit->visitor,
            'host_name' => $visit->host->host_name,
            'host_email' => $visit->host->host_email,
            'host_number' => $visit->host->host_number,
            'visitNumber' => $visitNumber,
        ];

        // Send email notifications
        try {
            Mail::to($emailData['visitor']->email)->send(new VisitBooked($emailData)); // Send only once
            Mail::to($visit->host->host_email)->send(new HostVisitNotification($emailData['visitor'], $visit, $visit->host));
            Log::info('Emails sent successfully.');
        } catch (\Exception $e) {
            Log::error('Error sending emails:', ['exception' => $e]);
            return redirect()->back()->withErrors(['email' => 'Error sending email. Please try again later.']);
        }

        // Pass the visit data to the view
        return redirect()->route('index')->with('success', "Visit booked successfully! Your visit number is: <span style='color: red; font-weight: bold;'>$visitNumber</span> . You can share this number to let someone else join the visit.")
            ->with('visit_number', $visitNumber);
    }

    public function joinVisit(Request $request)
    {
        $request->validate([
            'visit_number' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:15',
            'id_number' => 'required|string|max:20',
        ]);

        // Find the visit by visit number
        $visit = Visit::where('visit_number', $request->visit_number)->first();

        if (!$visit) {
            Log::warning('Visit not found', ['visit_number' => $request->visit_number]);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'The visit number you entered does not exist. Please check the number and try again.');
        }

        // Create new visitor for this specific visit directly
        $joiningVisitor = Visitor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'designation' => $request->designation,
            'organization' => $request->organization,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'id_number' => $request->id_number,
        ]);

        // Save the visitor
        if (!$joiningVisitor->save()) {
            Log::error('Failed to save joining visitor', ['visit_number' => $visit->visit_number]);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to save visitor information. Please try again.');
        }

        // Associate visitor with visit
        $visit->visitors()->attach($joiningVisitor->id);

        // Update visit status to 'joined'
        $visit->update(['status' => 'joined']);

        // Send email notifications
        try {
            Log::info('Sending email');
            Mail::to($joiningVisitor->email)->send(new VisitorJoined($joiningVisitor, $visit, true));
            Mail::to($visit->visitor->email)->send(new VisitorJoined($joiningVisitor, $visit, false));
            Mail::to($visit->host->host_email)->send(new HostVisitJoined($joiningVisitor, $visit, $visit->host)); // Use new mailable
            Log::info('Emails sent successfully.');
        } catch (\Exception $e) {
            Log::error('Error sending emails:', ['exception' => $e]);
            return redirect()->back()->withErrors(['email' => 'Error sending email. Please try again later.']);
        }

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
            Mail::to($visit->host->host_email)->send(new VisitorJoined($visit, $request->visit_number));
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
        try {
            $request->validate([
                'visit_number' => 'required|string|exists:visits,visit_number',
            ]);

            Log::info("Visit number validated successfully: " . $request->visit_number);

            // Find the visit
            $visit = Visit::where('visit_number', $request->visit_number)->firstOrFail();
            Log::info("Visit found: " . $visit->id);

            // Update visit status
            $visit->update(['status' => 'checked_in']);

            // Get related visitors
            $visitors = Visitor::where('visit_number', $visit->visit_number)->get();
            $totalVisitors = $visitors->count();

            // Retrieve the associated visitor - first try by visitor_id, then by visit_number
            $visitor = Visitor::find($visit->visitor_id);

            if (!$visitor) {
                $visitor = Visitor::where('visit_number', $visit->visit_number)->first();
                if (!$visitor) {
                    Log::error("Visitor not found for visit ID: " . $visit->visitor_id . " or visit number: " . $visit->visit_number);
                    return redirect()->back()->withErrors(['visit_number' => 'Visitor not found for this visit.']);
                }
            }

            try {
                // Log before redirect
                Log::info("Attempting to redirect to visit status page with visit ID: " . $visit->id);

                // Redirect to visit status page
                return redirect()->route('visits.status', ['visit' => $visit->visit_number])
                    ->with('success', 'Check-in successful!');
            } catch (\Exception $e) {
                Log::error("Error during check-in process: " . $e->getMessage());
                return redirect()->back()->withErrors(['error' => 'An error occurred during check-in. Please try again.']);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('index')
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error("Error during check-in process: " . $e->getMessage());
            return redirect()->route('index')
                ->with('error', 'An error occurred during check-in. Please try again.');
        }
    }

    public function showVisitStatus(Request $request)
    {
        $request->validate([
            'visit' => 'required|string|exists:visits,visit_number',
        ]);

        $visitNumber = $request->input('visit');
        $visitRecord = Visit::where('visit_number', $visitNumber)->with('host', 'visitors')->first();

        if (!$visitRecord) {
            return redirect()->route('index')->with('error', 'Visit not found.');
        }

        $visitors = $visitRecord->visitors;
        $totalVisitors = $visitors->count();

        return view('visit-status', compact('visitRecord', 'totalVisitors', 'visitors'));
    }
}
