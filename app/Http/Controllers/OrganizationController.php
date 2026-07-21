<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\Institution;

class OrganizationController extends Controller
{

    // Centralized method to log activity
    private function logActivity(string $description)
    {
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'description' => $description
        ]);
    }

    // Display a listing of organizations (admin page)
    public function index(Request $request)
    {
        $organizations = Organization::paginate(15);

        return view('organizations.index', compact('organizations'));
    }

    // Show the form for creating a new organization
    public function create()
    {
        $institutions = Institution::all();

        return view('organizations.create', compact('institutions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'institution_id'     => 'required|exists:institutions,id',
            'affiliation_number' => 'required|string|max:255',
            'organization_name'  => 'required|string|max:255',
            'contact_number'     => 'required|string|max:20',
            'email'              => 'required|email|max:255',
        ]);

        $institution = Institution::findOrFail($request->institution_id);

        $data = $request->all();
        $data['college_name'] = $institution->full_name ?? $institution->name;

        $existing = Organization::where('institution_id', $data['institution_id'])->first();
        if ($existing) {
            return redirect()->back()->withInput()->withErrors([
                'institution_id' => 'An organization for the selected institution already exists. Please edit the existing one.',
            ]);
        }

        $organization = Organization::create($data);
        $this->logActivity('Created organization: ' . $organization->organization_name);

        $affiliationNumber = $request->input('affiliation_number');
        if ($affiliationNumber && $institution) {
            $students = $institution->students()->whereNotNull('membership_number')->get();
            foreach ($students as $student) {
                $rawNumber = $student->getRawOriginal('membership_number');
                $parts = explode('/', $rawNumber);
                if (count($parts) === 4) {
                    $parts[2] = $affiliationNumber;
                    $student->membership_number = implode('/', $parts);
                    $student->save();
                }
            }
        }

        return redirect()->route('organizations.index')->with('success', 'Organization added successfully');
    }

    // Show the form for editing the specified organization
    public function edit(Organization $organization)
    {
        $institutions = Institution::all();

        return view('organizations.edit', compact('organization', 'institutions'));
    }

    // Update the specified organization
    public function update(Request $request, Organization $organization)
    {
        $request->validate([
            'affiliation_number' => 'required|string|max:255',
            'organization_name'  => 'required|string|max:255',
            'contact_number'     => 'required|string|max:20',
            'email'              => 'required|email|max:255',
        ]);

        $organization->update($request->all());
        $this->logActivity('Updated organization: ' . $organization->organization_name);

        $affiliationNumber = $request->input('affiliation_number');
        $institution = Institution::find($organization->institution_id);
        if ($affiliationNumber && $institution) {
            $students = $institution->students()->whereNotNull('membership_number')->get();
            foreach ($students as $student) {
                $rawNumber = $student->getRawOriginal('membership_number');
                $parts = explode('/', $rawNumber);
                if (count($parts) === 4) {
                    $parts[2] = $affiliationNumber;
                    $student->membership_number = implode('/', $parts);
                    $student->save();
                }
            }
        }

        return redirect()->route('organizations.index')->with('success', 'Organization updated successfully');
    }

    // Remove the specified organization
    public function destroy($id)
    {
        $organization = Organization::findOrFail($id);
        $organizationName = $organization->organization_name;

        $organization->delete();
        $this->logActivity('Deleted organization: ' . $organizationName);

        return redirect()->route('organizations.index')->with('success', 'Organization deleted successfully.');
    }

    // Verify organization status
    public function verify(Request $request, Organization $organization)
    {
        $request->validate([
            'status' => 'required|in:pending,verified',
        ]);

        $organization->status = $request->status;
        $organization->save();

        $this->logActivity("Changed status of organization {$organization->organization_name} to {$organization->status}");

        return redirect()->back()->with('success', 'Organization status updated successfully.');
    }
}
