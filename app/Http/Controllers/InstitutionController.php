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
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'uid'              => 'required|string|unique:students,uid',
            'class'            => 'required|string|in:HS1,HS2,HS3,S1,S2,D1,D2,D3,D4,PG1,PG2',
            'stream'           => 'required|string|in:sharia,sharia plus,she,she plus,life,life plus,bayyinath,life for girls,life plus for girls',
            'contact_number'   => 'required|string|max:20',
            'whatsapp_number'  => 'required|string|max:20',
            'country'          => 'required|string|max:100',
            'state'            => 'required|string|max:100',
            'district'         => 'required|string|max:100',
            'constituency'     => 'required|string|max:100',
            'place'            => 'required|string|max:100',
            'date_of_birth'    => 'required|date|before:today',
            'photo'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'interested_areas' => 'nullable|array',
            'interested_areas.*' => 'string|max:100',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('students/photos', 'public');
        }

        // Merge custom text into interested_areas
        $interestedAreas = $request->input('interested_areas', []);
        if (in_array('Other Languages', $interestedAreas) && $request->filled('other_languages_text')) {
            $key = array_search('Other Languages', $interestedAreas);
            $interestedAreas[$key] = 'Other Languages: ' . trim($request->input('other_languages_text'));
        }
        if (in_array('Others', $interestedAreas) && $request->filled('others_text')) {
            $key = array_search('Others', $interestedAreas);
            $interestedAreas[$key] = 'Others: ' . trim($request->input('others_text'));
        }
        $validated['interested_areas'] = array_values($interestedAreas);

        auth()->user()->students()->create(array_merge($validated, [
            'status' => 'pending',
        ]));

        return redirect()
            ->route('institution.students.index')
            ->with('success', 'Student added successfully.');
    }

    public function studentsEdit(Student $student)
    {
        return view('institution.students.edit', compact('student'));
    }

    public function studentsUpdate(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'uid'                => 'required|string|unique:students,uid,' . $student->id,
            'class'              => 'required|string|in:HS1,HS2,HS3,S1,S2,D1,D2,D3,D4,PG1,PG2',
            'stream'             => 'required|string|in:sharia,sharia plus,she,she plus,life,life plus,bayyinath,life for girls,life plus for girls',
            'contact_number'     => 'required|string|max:20',
            'whatsapp_number'    => 'required|string|max:20',
            'country'            => 'required|string|max:100',
            'state'              => 'required|string|max:100',
            'district'           => 'required|string|max:100',
            'constituency'       => 'required|string|max:100',
            'place'              => 'required|string|max:100',
            'date_of_birth'      => 'required|date|before:today',
            'photo'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'interested_areas'   => 'nullable|array',
            'interested_areas.*' => 'string|max:100',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($student->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($student->photo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($student->photo);
            }
            $validated['photo'] = $request->file('photo')->store('students/photos', 'public');
        }

        // Merge custom text into interested_areas
        $interestedAreas = $request->input('interested_areas', []);
        if (in_array('Other Languages', $interestedAreas) && $request->filled('other_languages_text')) {
            $key = array_search('Other Languages', $interestedAreas);
            $interestedAreas[$key] = 'Other Languages: ' . trim($request->input('other_languages_text'));
        }
        if (in_array('Others', $interestedAreas) && $request->filled('others_text')) {
            $key = array_search('Others', $interestedAreas);
            $interestedAreas[$key] = 'Others: ' . trim($request->input('others_text'));
        }
        $validated['interested_areas'] = array_values($interestedAreas);

        $student->update($validated);


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
