<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Payment;
use App\Models\Institution;
use App\Models\InstitutionData;

class InstitutionDashboardController extends Controller
{
    // Middleware to ensure only authenticated institutions access
    public function __construct()
    {
        $this->middleware('auth:institution');
    }

    // Dashboard
    public function index()
    {
        $institution = auth()->guard('institution')->user()->fresh();

        $organization = $institution->organization; // Assuming relationship exists
        $students_count = $institution->students()->count();
        $recent_students = $institution->students()->latest()->take(5)->get();

        // Latest payment
        $last_payment = Payment::where('institution_name', $institution->name)
            ->latest('created_at')
            ->first();

        // Latest submitted institution data
        $selectedData = InstitutionData::where('institution_id', $institution->id)->latest()->first();

        return view('institution.dashboard', compact(
            'institution',
            'organization',
            'students_count',
            'recent_students',
            'last_payment',
            'selectedData'
        ));
    }

    // Students listing
    public function studentsIndex()
    {
        $institution = auth()->guard('institution')->user()->fresh();
        $students = $institution->students()->paginate(10);

        return view('institution.students.index', compact('students'));
    }

    // Show add student form
    public function studentsCreate()
    {
        return view('institution.students.create');
    }

    // Store new student
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
}
