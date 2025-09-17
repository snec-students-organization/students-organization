<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeatureFlag;

class FeatureFlagController extends Controller
{
    public function index()
    {
        $flags = FeatureFlag::all();
        return view('admin.feature_flags.index', compact('flags'));
    }

    public function update(Request $request, FeatureFlag $flag)
    {
        $flag->is_active = $request->boolean('is_active');
        $flag->save();

        return redirect()->route('admin.feature_flags.index')
            ->with('success', ucfirst(str_replace('_', ' ', $flag->feature_name)) . ' updated successfully.');
    }
}

