<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    // Show list of students for the logged-in institution
    public function studentsIndex()
    {
        $institution = auth()->user(); // Assuming institution user is logged in
        $students = $institution->students()->paginate(10);
        return view('institution.students.index', compact('students'));
    }

    // Show form to add a new student
    public function studentsCreate()
    {
        return view('institution.students.create');
    }

    // Store new student submitted from the form
    public function studentsStore(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'uid'   => 'required|string|unique:students,uid',
            'class' => 'required|string|max:100',
        ]);

        auth()->user()->students()->create([
            'name'   => $request->name,
            'uid'    => $request->uid,
            'class'  => $request->class,
            'status' => 'pending', // New students start with pending status
        ]);

        return redirect()->route('institution.students.index')->with('success', 'Student added and pending admin verification.');
    }
}
