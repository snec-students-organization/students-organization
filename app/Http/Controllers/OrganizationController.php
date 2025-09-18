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
            'user_id' => auth()->user()->id, // Authenticated user ID
            'description' => $description
        ]);
    }

    // Display a listing of organizations with optional stream filtering (admin page)
    public function index(Request $request)
    {
        $streams = ['sharea', 'sharea plus', 'life', 'life plus', 'bayyinath', 'she', 'she plus'];
        $selectedStream = $request->input('stream');

        // Filter organizations by selected stream if present, paginate results
        $organizations = Organization::when($selectedStream, function ($query, $stream) {
            return $query->where('stream', $stream);
        })->paginate(15);

        return view('organizations.index', compact('organizations', 'streams', 'selectedStream'));
    }

    // Show the form for creating a new organization
    public function create()
{
    $streams = ['sharea', 'sharea plus', 'life', 'life plus', 'bayyinath', 'she', 'she plus'];
    $institutions = Institution::all(); // Fetch all institutions for dropdown

    return view('organizations.create', compact('streams', 'institutions'));
}


    // Store a newly created organization in database
    public function store(Request $request)
{
    $request->validate([
        'institution_id' => 'required|exists:institutions,id',
        'organization_name' => 'required|string|max:255',
        'organization_director_name' => 'required|string|max:255',
        'organization_director_number' => 'required|string|max:15',
        'counciler_name' => 'required|string|max:255',
        'counciler_number' => 'required|string|max:15',
        'chairman_name' => 'required|string|max:255',
        'chairman_number' => 'required|string|max:15',
        'convenor_name' => 'required|string|max:255',
        'convenor_number' => 'required|string|max:15',
        'stream' => 'required|string|in:sharea,sharea plus,life,life plus,bayyinath,she,she plus',
    ]);

    $institution = Institution::findOrFail($request->institution_id);

    $data = $request->all();
    $data['college_name'] = $institution->full_name ?? $institution->name; // 👈 auto-fill here

    // Prevent duplicate organizations for the same institution
    $existing = Organization::where('institution_id', $data['institution_id'])->first();
    if ($existing) {
        return redirect()->back()->withInput()->withErrors([
            'institution_id' => 'An organization for the selected institution already exists. Please edit the existing one.',
        ]);
    }

    $organization = Organization::create($data);

    $this->logActivity('Created organization: ' . $organization->organization_name);

    return redirect()->route('organizations.index')->with('success', 'Organization added successfully');
}



    // Show the form for editing the specified organization
    public function edit(Organization $organization)
{
    $streams = ['sharea', 'sharea plus', 'life', 'life plus', 'bayyinath', 'she', 'she plus'];
    $institutions = Institution::all(); // Add this line to pass institutions

    return view('organizations.edit', compact('organization', 'streams', 'institutions'));
}


    // Update the specified organization in database
    public function update(Request $request, Organization $organization)
    {
        $request->validate([
            
            'organization_name' => 'required|string|max:255',
            'organization_director_name' => 'required|string|max:255',
            'organization_director_number' => 'required|string|max:15',
            'counciler_name' => 'required|string|max:255',
            'counciler_number' => 'required|string|max:15',
            'chairman_name' => 'required|string|max:255',
            'chairman_number' => 'required|string|max:15',
            'convenor_name' => 'required|string|max:255',
            'convenor_number' => 'required|string|max:15',
            'stream' => 'required|string|in:sharea,sharea plus,life,life plus,bayyinath,she,she plus',
        ]);

        $organization->update($request->all());

        $this->logActivity('Updated organization: ' . $organization->organization_name);

        return redirect()->route('organizations.index')->with('success', 'Organization updated successfully');
    }

    // Remove the specified organization from database
    public function destroy($id)
    {
        $organization = Organization::findOrFail($id);
        $organizationName = $organization->organization_name;

        $organization->delete();

        $this->logActivity('Deleted organization: ' . $organizationName);

        return redirect()->route('organizations.index')->with('success', 'Organization deleted successfully.');
    }
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
