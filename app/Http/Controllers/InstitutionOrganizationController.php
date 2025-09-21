<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;

class InstitutionOrganizationController extends Controller
{
    // Centralized streams list
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

    // Show form to add or edit organization. Load existing if found.
    public function showOrganizationFormForInstitution()
    {
        $institution = auth()->guard('institution')->user();
        $organization = Organization::where('institution_id', $institution->id)->first();

        $streams = $this->streams;

        return view('institution.organization.form', compact('organization', 'streams'));
    }

    // Save or update on form submission (for create or edit)
    public function saveOrganizationForInstitution(Request $request)
    {
        $institution = auth()->guard('institution')->user();

        $data = $request->validate([
            'college_name' => 'required|string|max:255',
            'organization_name' => 'required|string|max:255',
            'organization_director_name' => 'nullable|string|max:255',
            'organization_director_number' => 'nullable|string|max:255',
            'counciler_name' => 'nullable|string|max:255',
            'counciler_number' => 'nullable|string|max:255',
            'chairman_name' => 'nullable|string|max:255',
            'chairman_number' => 'nullable|string|max:255',
            'convenor_name' => 'nullable|string|max:255',
            'convenor_number' => 'nullable|string|max:255',
            'stream' => 'required|string|in:' . implode(',', $this->streams),
        ]);

        $data['institution_id'] = $institution->id;

        Organization::updateOrCreate(
            ['institution_id' => $institution->id],
            $data
        );

        return redirect()
            ->route('institution.organization.form')
            ->with('success', 'Organization details saved successfully.');
    }
}
