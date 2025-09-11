<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Payment;
use App\Models\Institution;

class InstitutionDashboardController extends Controller
{
    // Middleware to ensure only authenticated institutions access
    public function __construct()
    {
        $this->middleware('auth:institution');
    }

    public function index()
    {
        // Always reload fresh institution data
        $institution = auth()->guard('institution')->user()->fresh();

        $organization = $institution->organization; // Assuming relationship exists
        $students_count = $institution->students()->count();
        $recent_students = $institution->students()->latest()->take(5)->get();

        // Use created_at to get the latest payment since paid_at doesn't exist
        $last_payment = Payment::where('institution_name', $institution->name)
            ->latest('created_at')
            ->first();

        return view('institution.dashboard', compact(
            'institution',
            'organization',
            'students_count',
            'recent_students',
            'last_payment'
        ));
    }

    public function studentsIndex()
    {
        $institution = auth()->guard('institution')->user()->fresh();
        $students = $institution->students()->paginate(10);

        return view('institution.students.index', compact('students'));
    }

    public function studentsCreate()
    {
        return view('institution.students.create');
    }

    public function studentsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'uid' => 'required|string|unique:students,uid',
            'class' => 'required|string|max:100',
        ]);

        $institution = auth()->guard('institution')->user()->fresh();

        $institution->students()->create([
            'name' => $request->name,
            'uid' => $request->uid,
            'class' => $request->class,
            'status' => 'pending',
        ]);

        return redirect()->route('institution.students.index')
            ->with('success', 'Student added and pending admin verification.');
    }

    // Show edit form
    public function editDetails()
    {
        $institution = auth()->guard('institution')->user()->fresh();
        return view('institution.edit_details', compact('institution'));
    }

    // Handle update
    public function updateDetails(Request $request)
    {
        $institution = auth()->guard('institution')->user()->fresh();

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:100',
            'stream' => 'nullable|string|max:255',
            'affiliation_number' => 'nullable|string|max:100',
            'place' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'organization_name' => 'nullable|string|max:255',
            'organization_short_name' => 'nullable|string|max:100',
        ]);

        $institution->update($validated);

        return redirect()->route('institution.dashboard')
            ->with('success', 'Institution details updated successfully.');
    }

    // Show add details form
    public function addDetails()
    {
        $institution = auth()->guard('institution')->user()->fresh();

        // If details already exist, redirect to edit to avoid duplicates
        if ($institution->full_name) {
            return redirect()->route('institution.details.edit');
        }

        return view('institution.add_details', compact('institution'));
    }

    // Handle adding details form submission
    public function storeDetails(Request $request)
    {
        $institution = auth()->guard('institution')->user()->fresh();

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:100',
            'stream' => 'nullable|string|max:255',
            'affiliation_number' => 'nullable|string|max:100',
            'place' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'organization_name' => 'nullable|string|max:255',
            'organization_short_name' => 'nullable|string|max:100',
        ]);

        // Prevent duplicate if details exist
        if ($institution->full_name) {
            return redirect()->route('institution.details.edit')
                ->with('error', 'Details already added.');
        }

        $institution->update($validated); // Save details on same record

        return redirect()->route('institution.dashboard')
            ->with('success', 'Institution details added successfully.');
    }
}
