<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\UpcomingEvent;
use App\Models\FeatureFlag;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    // Dashboard
    public function dashboard()
{
    $user = auth()->user();

    $upcomingEvents = UpcomingEvent::where('event_date', '>=', now())
        ->orderBy('event_date', 'asc')
        ->get();

    $student = Student::where('uid', $user->uid)->with('institution')->first();

    $message = null;
    if ($student) {
        if ($student->status === 'verified') {
            $message = 'You are a member of our SSO family';
        } else {
            $message = 'Please pay the working fund and take the membership';
        }
    } else {
        $message = 'Your UID is not associated with any institution record.';
    }

    return view('user.dashboard', compact('message', 'upcomingEvents', 'student'));
}

    // Show form for submitting or editing student data
    public function submitDataForm()
    {
        // Check feature flag before showing the form
        $flag = FeatureFlag::where('feature_name', 'student_data')->first();
        if (!$flag || !$flag->is_active) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Student data submission is currently disabled by the admin.');
        }

        $user = auth()->user();

        // Check if student record exists
        $student = Student::where('uid', $user->uid)->first();

        // Pass student (may be null) to view
        return view('user.student-details', compact('student'));
    }

    // Store or update student data
    public function submitData(Request $request)
    {
        // Check feature flag before processing submission
        $flag = FeatureFlag::where('feature_name', 'student_data')->first();
        if (!$flag || !$flag->is_active) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Student data submission is currently disabled by the admin.');
        }

        $user = auth()->user();

        $student = Student::where('uid', $user->uid)->first();

        // Validation rules
        $rules = [
            'name'           => 'required|string|max:255',
            'uid'            => 'required|string|unique:students,uid,' . ($student->id ?? 'NULL'),
            'stream'         => 'required|in:sharea,sharea_plus,she,she_plus,life,life_plus,bayyinath',
            'class'          => 'required|in:hs1,hs2,hs3,s1,s2,d1,d2,d3,d4,pg1,pg2',
            'father_name'    => 'required|string|max:255',
            'address'        => 'required|string|max:1000',
            'contact_number' => 'required|string|max:20',
        ];

        $validated = $request->validate($rules);

        if ($student) {
            // Update existing record
            $student->update($validated);
        } else {
            // Create new record
            Student::create(array_merge($validated, [
                'institution_id' => $user->institution_id ?? null,
                'status' => 'pending',
            ]));
        }

        return redirect()->route('user.dashboard')->with('success', 'Student data saved successfully. Pending admin verification.');
    }

    // Show form for editing student details
    public function editDetails()
    {
        // Check feature flag before allowing edit
        $flag = FeatureFlag::where('feature_name', 'student_data')->first();
        if (!$flag || !$flag->is_active) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Editing student data is currently disabled by the admin.');
        }

        $user = auth()->user();

        // Find the student record associated with the logged-in user
        $student = Student::where('uid', $user->uid)->firstOrFail();

        // Pass it to the view
        return view('user.student-details', compact('student'));
    }

    // Update existing student details
    public function updateDetails(Request $request)
    {
        // Check feature flag before allowing update
        $flag = FeatureFlag::where('feature_name', 'student_data')->first();
        if (!$flag || !$flag->is_active) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Updating student data is currently disabled by the admin.');
        }

        $user = auth()->user();
        $student = Student::where('uid', $user->uid)->firstOrFail();

        $request->validate([
            'father_name'    => 'required|string|max:255',
            'address'        => 'required|string|max:500',
            'contact_number' => 'required|string|max:20',
        ]);

        $student->update([
            'father_name'    => $request->father_name,
            'address'        => $request->address,
            'contact_number' => $request->contact_number,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Details updated successfully!');
    }

    // Optional: Admin can list all users
    public function index()
    {
        $users = \App\Models\User::paginate(10);
        return view('admin.users.index', compact('users'));
    }
    public function downloadMembership()
{
    $student = Student::where('uid', auth()->user()->uid)->with('institution')->firstOrFail();

    if ($student->status !== 'verified') {
        return back()->with('error', 'Membership not verified yet.');
    }

    $pdf = Pdf::loadView('user.membership-pdf', compact('student'));
    return $pdf->download('membership-card.pdf');
}
}
