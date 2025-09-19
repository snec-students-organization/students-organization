<?php

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

        $institution = Auth::guard('institution')->user();
        $institutionData = InstitutionData::where('institution_id', $institution->id)->first();

        return view('institution_data.form', compact('institution', 'institutionData'));
    }

    public function store(Request $request)
    {
        $flag = FeatureFlag::where('feature_name', 'data_collection')->first();
        if (!$flag || !$flag->is_active) {
            abort(404);
        }

        $request->validate([
            'college_name' => 'required|string|max:255',
            'stream' => 'required|in:sharea,sharea plus,she,she plus,life,life plus,bayyinath',
            'affiliation_number' => 'required|string|max:100',
            'full_address' => 'required|string',
            'college_organization_full_name' => 'required|string|max:255',
            'college_organization_short_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'organization_director_name' => 'required|string|max:255',
            'organization_director_contact' => 'required|string|max:50',
            'chairman_name' => 'required|string|max:255',
            'chairman_contact' => 'required|string|max:50',
            'convener_name' => 'required|string|max:255',
            'convener_contact' => 'required|string|max:50',
            'treasurer_name' => 'required|string|max:255',
            'treasurer_contact' => 'required|string|max:50',
            'councilers_name_contact' => 'required|string',
        ]);

        $institution = Auth::guard('institution')->user();

        // ✅ Save/update institution data without membership_number
        $institution->institutionData()->updateOrCreate(
            [], // no extra condition needed since it's already tied to this institution
            $request->only([
                'college_name',
                'stream',
                'affiliation_number',
                'full_address',
                'college_organization_full_name',
                'college_organization_short_name',
                'email',
                'organization_director_name',
                'organization_director_contact',
                'chairman_name',
                'chairman_contact',
                'convener_name',
                'convener_contact',
                'treasurer_name',
                'treasurer_contact',
                'councilers_name_contact'
            ])
        );

        return redirect()->route('institution.dashboard')->with('success', 'Institution data submitted successfully.');
    }
}
