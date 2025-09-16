<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\UpcomingEvent;

class UserController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $user = auth()->user();
        $message = null;

        $upcomingEvents = UpcomingEvent::where('event_date', '>=', now())
                          ->orderBy('event_date', 'asc')
                          ->get();

        $student = Student::where('uid', $user->uid)->first();

        if ($student) {
            if ($student->status === 'verified') {
                $message = 'You are a member of our SSO family';
            } else {
                $message = 'Please pay the working fund and take the membership';
            }
        } else {
            $message = 'Your UID is not associated with any institution record.';
        }

        return view('user.dashboard', compact('message', 'upcomingEvents'));
    }

    // Show form to submit new student data
     // Show form for submitting or editing student data
    public function submitDataForm()
    {
        $user = auth()->user();

        // Check if student record exists
        $student = Student::where('uid', $user->uid)->first();

        // Pass student (may be null) to view
        return view('user.student-details', compact('student'));
    }

    // Store submitted student data
    // Store or update student data
    public function submitData(Request $request)
    {
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
    $user = auth()->user();

    // Find the student record associated with the logged-in user
    $student = Student::where('uid', $user->uid)->firstOrFail();

    // Pass it to the view
    return view('user.student-details', compact('student'));
}


    // Update existing student details
    public function updateDetails(Request $request)
    {
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
}
