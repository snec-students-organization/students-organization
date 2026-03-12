<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OnlineCourseActivity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = OnlineCourseActivity::latest()->get();
        return view('admin.online-course.activities', compact('activities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
        ]);

        OnlineCourseActivity::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'link' => $validated['link'],
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Activity created successfully.');
    }

    public function destroy(OnlineCourseActivity $activity)
    {
        $activity->delete();
        return back()->with('success', 'Activity deleted successfully.');
    }
}
