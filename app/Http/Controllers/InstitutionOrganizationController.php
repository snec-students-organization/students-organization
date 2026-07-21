<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;

class InstitutionOrganizationController extends Controller
{
    // Show form to add or edit organization. Load existing if found.
    public function showOrganizationFormForInstitution()
    {
        $institution = auth()->guard('institution')->user();
        $organization = Organization::where('institution_id', $institution->id)->first();

        return view('institution.organization.form', compact('organization'));
    }

    // Save or update on form submission (for create or edit)
    public function saveOrganizationForInstitution(Request $request)
    {
        $institution = auth()->guard('institution')->user();

        $data = $request->validate([
            'college_name'       => 'required|string|max:255',
            'affiliation_number' => 'required|string|max:255',
            'organization_name'  => 'required|string|max:255',
            'contact_number'     => 'required|string|max:20',
            'email'              => 'required|email|max:255',
        ]);

        $data['institution_id'] = $institution->id;

        Organization::updateOrCreate(
            ['institution_id' => $institution->id],
            $data
        );

        $affiliationNumber = $request->input('affiliation_number');
        if ($affiliationNumber) {
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

        return redirect()
            ->route('institution.organization.form')
            ->with('success', 'Organization details saved successfully.');
    }
}
