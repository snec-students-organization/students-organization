<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Event;
use App\Models\User;
use App\Models\ActivityLog; 
use App\Models\Institution;
use App\Models\Student;
use Illuminate\Http\Request;

class AdminController extends Controller
{   
    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        $orgCount   = Organization::count();
        $eventCount = Event::count();
        $userCount  = User::count();
        $studentCount = Student::count();

        $upcomingEvents = Event::where('start', '>=', now())
                               ->orderBy('start', 'asc')
                               ->take(5)
                               ->get();

        $activities = ActivityLog::latest()->take(10)->get();

        $quickLinks = [
            'new_event'        => route('admin.events.create'),
            'add_organization' => route('admin.organizations.create'),
            'manage_users'     => route('admin.users.index'),
            'manage_students'  => route('admin.students.index'),
        ];

        return view('admin.dashboard', compact(
            'orgCount',
            'eventCount',
            'userCount',
            'studentCount',
            'upcomingEvents',
            'activities',
            'quickLinks'
        ));
    }

    /**
     * Show all students grouped by institution
     */
    public function studentsIndex()
    {
        $institutions = Institution::with('students')->get();
        return view('admin.students.index', compact('institutions'));
    }

    /**
     * Update student status (pending/verified/working_fund)
     */
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
    public function studentsByInstitution(Request $request)
{
    $query = Institution::with('students');

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $institutions = $query->get();

    return view('admin.students.index', compact('institutions'));
}

}

