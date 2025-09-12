<?php

// app/Http/Controllers/Admin/FeatureFlagController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeatureFlag;

class FeatureFlagController extends Controller
{
    public function edit()
    {
        $flag = FeatureFlag::where('feature_name', 'data_collection')->firstOrFail();
        return view('admin.feature_flags.edit', compact('flag'));
    }

    public function update(Request $request)
    {
        $flag = FeatureFlag::where('feature_name', 'data_collection')->firstOrFail();
        $flag->is_active = $request->boolean('is_active');
        $flag->save();

        return redirect()->route('admin.feature_flags.edit')->with('success', 'Data Collection Section updated.');
    }
}
