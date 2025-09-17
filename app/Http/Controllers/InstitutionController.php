<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    public function studentsIndex()
    {
        $institution = auth()->user();
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
        'name'   => 'required|string|max:255',
        'uid'    => 'required|string|unique:students,uid',
        'class'  => 'required|string|in:HS1,HS2,HS3,S1,S2,D1,D2,D3,D4,PG1,PG2',
        'stream' => 'required|string|in:sharea,sharea plus,she,she plus,life,life plus,bayyinath',
    ]);

    auth()->user()->students()->create([
        'name'   => $request->name,
        'uid'    => $request->uid,
        'class'  => $request->class,
        'stream' => $request->stream,
        'status' => 'pending',
    ]);

    return redirect()
        ->route('institution.students.index')
        ->with('success', 'Student added successfully. Waiting for user to complete details.');
}

}
