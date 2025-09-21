<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\Institution;

class OrganizationController extends Controller
{
    // ✅ Centralized list of streams
    private $streams = [
        'sharia',
        'sharia plus',
        'life',
        'life plus',
        'life for girls',
        'life plus for girls',
        'bayyinath',
        'she',
        'she plus',
    ];

    // Centralized method to log activity
    private function logActivity(string $description)
    {
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'description' => $description
        ]);
    }

    // Display a listing of organizations with optional stream filtering (admin page)
    public function index(Request $request)
    {
        $streams = $this->streams;
        $selectedStream = $request->input('stream');

        $organizations = Organization::when($selectedStream, function ($query, $stream) {
            return $query->where('stream', $stream);
        })->paginate(15);

        return view('organizations.index', compact('organizations', 'streams', 'selectedStream'));
    }

    // Show the form for creating a new organization
    public function create()
    {
        $streams = $this->streams;
        $institutions = Institution::all();

        return view('organizations.create', compact('streams', 'institutions'));
    }

    // Store a newly created organization
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
            'stream' => 'required|string|in:' . implode(',', $this->streams),
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

        return redirect()->route('organizations.index')->with('success', 'Organization added successfully');
    }

    // Show the form for editing the specified organization
    public function edit(Organization $organization)
    {
        $streams = $this->streams;
        $institutions = Institution::all();

        return view('organizations.edit', compact('organization', 'streams', 'institutions'));
    }

    // Update the specified organization
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
            'stream' => 'required|string|in:' . implode(',', $this->streams),
        ]);

        $organization->update($request->all());
        $this->logActivity('Updated organization: ' . $organization->organization_name);

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
