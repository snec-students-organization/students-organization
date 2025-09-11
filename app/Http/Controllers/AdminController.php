<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Event;
use App\Models\User;
use App\Models\ActivityLog; // optional if you have activity logs
use Illuminate\Http\Request;
use App\Models\Student;
class AdminController extends Controller
{   
    public function dashboard()
{
    $orgCount   = Organization::count();
    $eventCount = Event::count();
    $userCount  = User::count();

    $upcomingEvents = Event::where('start', '>=', now())
                           ->orderBy('start', 'asc')
                           ->take(5)
                           ->get();

    $activities = ActivityLog::latest()->take(10)->get();

    $quickLinks = [
        'new_event' => route('admin.events.create'),
        'add_organization' => route('admin.organizations.create'),
        'add_user' => route('admin.users.index'),
        'generate_report' => route('admin.dashboard') // placeholder
    ];

    return view('admin.dashboard', compact(
        'orgCount',
        'eventCount',
        'userCount',
        'upcomingEvents',
        'activities',
        'quickLinks'
    ));
}
public function studentsIndex()
{
    $institutions = \App\Models\Institution::with('students')->orderBy('name')->get();
    return view('admin.students.index', compact('institutions'));
}


public function updateStudentStatus(Request $request, Student $student)
{
    $request->validate([
        'status' => 'required|in:pending,verified,working_fund',
    ]);

    $student->update([
        'status' => $request->status,
    ]);

    return back()->with('success', 'Student status updated.');
}

}
