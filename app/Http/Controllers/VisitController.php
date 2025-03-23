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
        // Generate a unique visit number
        $visitNumber = Visit::generateVisitNumber();
        Log::info("Generated visit number: " . $visitNumber);

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

        // Create new visitor for this visit
        $visitor = new Visitor();
        $visitor->fill([
            'visitor_name' => $validatedData['visitor_name'],
            'visitor_last_name' => $validatedData['visitor_last_name'],
            'designation' => $validatedData['designation'],
            'organization' => $validatedData['organization'],
            'visitor_email' => $validatedData['visitor_email'],
            'visitor_number' => $validatedData['visitor_number'],
            'id_number' => $validatedData['id_number'],
            'visit_number' => $visitNumber,
        ]);

        // Save the visitor
        if (!$visitor->save()) {
            Log::error('Failed to save visitor', ['visit_number' => $visitNumber]);
            return redirect()->back()->withErrors(['error' => 'Failed to save visitor information. Please try again.']);
        }

        // Create the visit record
        $visit = Visit::create([
            'visit_number' => $visitNumber,
            'host_id' => $validatedData['host_id'],
            'visit_type' => $validatedData['visit_type'],
            'visit_facility' => $validatedData['visit_facility'],
            'visit_date' => $validatedData['visit_date'],
            'visit_from' => $validatedData['visit_from'],
            'visit_to' => $validatedData['visit_to'],
            'purpose_of_visit' => $validatedData['purpose_of_visit'],
            'visitor_id' => $visitor->id
        ]);

        // Associate the visitor with the visit
        $visit->visitors()->attach($visitor->id);

        // Log the visit number and set it in the session
        Log::info("Setting visit number in session: " . $visitNumber);
        session(['visit_number' => $visitNumber]);
        Log::info("Current session data: ", session()->all());

        // Retrieve the newly created visit
        $visit = Visit::where('visit_number', $visitNumber)->first();

        // Prepare data for the email
        $emailData = [
            'visit' => $visit,
            'host_name' => $visit->host->host_name,
            'host_email' => $visit->host->host_email,
            'host_number' => $visit->host->host_number,
            'visitNumber' => $visitNumber,
        ];

        // Send email notifications
        Mail::to($visitor->visitor_email)->send(new VisitBooked($emailData));
        Mail::to($visit->host->host_email)->send(new HostVisitNotification($visitor, $visit, $visit->host));

        // Pass the visit data to the view
        return redirect()->route('index')->with('success', "Visit booked successfully! Your visit number is: <span style='color: red; font-weight: bold;'>$visitNumber</span>. You can share this number to let someone else join the visit.")
            ->with('visit_number', $visitNumber);
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
            Log::warning('Visit not found', ['visit_number' => $request->visit_number]);
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'The visit number you entered does not exist. Please check the number and try again.');
        }

        // Create new visitor for this specific visit
        $joiningVisitor = new Visitor([
            'visitor_name' => $request->visitor_name,
            'visitor_last_name' => $request->visitor_last_name,
            'designation' => $request->designation,
            'organization' => $request->organization,
            'visitor_email' => $request->visitor_email,
            'visitor_number' => $request->visitor_number,
            'id_number' => $request->id_number,
            'visit_number' => $visit->visit_number,
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
        $visit->visitors()->save($joiningVisitor);

        // Update visit status to 'joined'
        $visit->update(['status' => 'joined']);

        // Get the original visitor's email
        $originalVisitorEmail = $visit->visitor->visitor_email;

        // Send email notifications
        Mail::to($joiningVisitor->visitor_email)->send(new VisitorJoined($joiningVisitor, $visit, true));
        Mail::to($originalVisitorEmail)->send(new VisitorJoined($joiningVisitor, $visit, false));

        // Send the joined visit notification to the host
        Mail::to($visit->host->host_email)->send(new HostVisitNotification($joiningVisitor, $visit, $visit->host));

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
