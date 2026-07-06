<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Event;
use App\Models\User;
use App\Models\ActivityLog; 
use App\Models\Institution;
use App\Models\Student;
use App\Models\AdmissionData;
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
        $admissionCount = AdmissionData::count();

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
            'admissionCount',
            'upcomingEvents',
            'activities',
            'quickLinks'
        ));
    }

    /**
     * Show all students grouped by institution
     */
    public function studentsIndex(Request $request)
    {
        return $this->studentsByInstitution($request);
    }

    /**
     * Update student status (pending/verified/working_fund)
     */
    public function updateStudentStatus(Request $request, Student $student)
    {
        $request->validate([
            'status' => 'required|in:pending,verified,working_fund',
        ]);

        // If status is being set to verified, assign membership number if not already
        if ($request->status === 'verified' && !$student->membership_number) {
            do {
                $random = 'SSO' . rand(10000, 99999);
            } while (Student::where('membership_number', $random)->exists());

            $student->membership_number = $random;
        }

        $student->status = $request->status;
        $student->save();

        return back()->with('success', 'Student status updated.');
    }

    public function studentsByInstitution(Request $request)
    {
        $query = Institution::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $stream = $request->input('stream');

        if ($request->filled('stream')) {
            $query->where('stream', $stream);
        }

        $query->with('students');

        $institutions = $query->get();
        $streams = ['sharia', 'sharia plus', 'she', 'she plus', 'life', 'life plus', 'bayyinath', 'life for girls', 'life plus for girls'];

        return view('admin.students.index', compact('institutions', 'streams'));
    }

    /**
     * Show dashboard for Boys Colleges Admin
     */
    public function boysDashboard(Request $request)
    {
        $search = $request->input('search');

        $shariaQuery = Institution::where('stream', 'sharia')->with('students');
        $shariaPlusQuery = Institution::where('stream', 'sharia plus')->with('students');
        $bayyinathQuery = Institution::where('stream', 'bayyinath')->with('students');

        if ($search) {
            $shariaQuery->where('name', 'like', '%' . $search . '%');
            $shariaPlusQuery->where('name', 'like', '%' . $search . '%');
            $bayyinathQuery->where('name', 'like', '%' . $search . '%');
        }

        $shariaInstitutions = $shariaQuery->get();
        $shariaPlusInstitutions = $shariaPlusQuery->get();
        $bayyinathInstitutions = $bayyinathQuery->get();

        $notifications = \App\Models\TalentsMeetNotification::where('sender_role', 'boys_admin')
            ->latest()
            ->get();

        return view('admin.students.boys_dashboard', compact(
            'shariaInstitutions',
            'shariaPlusInstitutions',
            'bayyinathInstitutions',
            'notifications'
        ));
    }

    /**
     * Show dashboard for Girls Colleges Admin
     */
    public function girlsDashboard(Request $request)
    {
        $search = $request->input('search');

        $sheQuery = Institution::where('stream', 'she')->with('students');
        $shePlusQuery = Institution::where('stream', 'she plus')->with('students');

        if ($search) {
            $sheQuery->where('name', 'like', '%' . $search . '%');
            $shePlusQuery->where('name', 'like', '%' . $search . '%');
        }

        $sheInstitutions = $sheQuery->get();
        $shePlusInstitutions = $shePlusQuery->get();

        $notifications = \App\Models\TalentsMeetNotification::where('sender_role', 'girls_admin')
            ->latest()
            ->get();

        return view('admin.students.girls_dashboard', compact(
            'sheInstitutions',
            'shePlusInstitutions',
            'notifications'
        ));
    }
}
