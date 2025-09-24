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
            'name'           => 'required|string|max:255',
            'father_name'    => 'required|string|max:255',
            'address'        => 'required|string|max:500',
            'contact_number' => 'required|string|max:20',
            'uid'            => 'required|string|unique:students,uid',
            'class'          => 'required|string|in:HS1,HS2,HS3,S1,S2,D1,D2,D3,D4,PG1,PG2',
            'stream'         => 'required|string|in:sharia,sharia plus,she,she plus,life,life plus,bayyinath,life for girls,life plus for girls',
        ]);

        auth()->user()->students()->create([
            'name'           => $request->name,
            'father_name'    => $request->father_name,
            'address'        => $request->address,
            'contact_number' => $request->contact_number,
            'uid'            => $request->uid,
            'class'          => $request->class,
            'stream'         => $request->stream,
            'status'         => 'pending',
        ]);

        return redirect()
            ->route('institution.students.index')
            ->with('success', 'Student added successfully. Waiting for user to complete details.');
    }
    public function studentsEdit(Student $student)
{
    return view('institution.students.edit', compact('student'));
}

public function studentsUpdate(Request $request, Student $student)
{
    $request->validate([
        'name'           => 'required|string|max:255',
        'father_name'    => 'required|string|max:255',
        'address'        => 'required|string|max:500',
        'contact_number' => 'required|string|max:20',
        'uid'            => 'required|string|unique:students,uid,' . $student->id,
        'class'          => 'required|string',
        'stream'         => 'required|string',
    ]);

    $student->update($request->all());

    return redirect()->route('institution.students.index')
                     ->with('success', 'Student updated successfully.');
}

public function studentsDestroy(Student $student)
{
    $student->delete();

    return redirect()->route('institution.students.index')
                     ->with('success', 'Student deleted successfully.');
}

}
