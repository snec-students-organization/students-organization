<?php

// app/Http/Controllers/InstitutionDataController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstitutionData;
use App\Models\FeatureFlag;
use Illuminate\Support\Facades\Auth;

class InstitutionDataController extends Controller
{
    public function create()
    {
        $flag = FeatureFlag::where('feature_name', 'data_collection')->first();
        if (!$flag || !$flag->is_active) {
            abort(404);
        }

        $institutionId = Auth::guard('institution')->id();
        $institutionData = InstitutionData::where('institution_id', $institutionId)->first();

        return view('institution_data.form', compact('institutionData'));
    }

    public function store(Request $request)
    {
        $flag = FeatureFlag::where('feature_name', 'data_collection')->first();
        if (!$flag || !$flag->is_active) {
            abort(404);
        }

        $request->validate([
            'college_name' => 'required|string|max:255',
            'stream' => 'required|string|max:255',
            'affiliation_number' => 'required|string|max:255',
            'full_address' => 'required|string',
            'college_organization_full_name' => 'required|string|max:255',
            'college_organization_short_name' => 'required|string|max:255',
            'membership_number' => 'required|string|max:255',
            'organization_director_name' => 'required|string|max:255',
            'organization_director_contact' => 'required|string|max:20',
            'chairman_name' => 'required|string|max:255',
            'chairman_contact' => 'required|string|max:20',
            'convener_name' => 'required|string|max:255',
            'convener_contact' => 'required|string|max:20',
            'treasurer_name' => 'required|string|max:255',
            'treasurer_contact' => 'required|string|max:20',
            'councilers_name_contact' => 'required|string',
        ]);

        $institutionId = Auth::guard('institution')->id();

        InstitutionData::updateOrCreate(
            ['institution_id' => $institutionId],
            $request->only([
                'college_name', 'stream', 'affiliation_number', 'full_address',
                'college_organization_full_name', 'college_organization_short_name', 'membership_number',
                'organization_director_name', 'organization_director_contact',
                'chairman_name', 'chairman_contact', 'convener_name', 'convener_contact',
                'treasurer_name', 'treasurer_contact', 'councilers_name_contact'
            ])
        );

        return redirect()->route('institution.dashboard')->with('success', 'Institution data submitted successfully.');
    }
}
