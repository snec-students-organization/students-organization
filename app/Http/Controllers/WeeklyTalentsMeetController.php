<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeeklyTalentsMeet;

class WeeklyTalentsMeetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:institution');
    }

    /**
     * Display a listing of weekly talents meets (Talents Meet Dashboard).
     */
    public function index()
    {
        $institution = auth()->guard('institution')->user();
        $meets = WeeklyTalentsMeet::where('institution_id', $institution->id)
            ->orderBy('meet_date', 'desc')
            ->paginate(10);

        $stream = $institution->stream;
        $senderRole = null;
        if (in_array($stream, ['she', 'she plus'])) {
            $senderRole = 'girls_admin';
        } elseif (in_array($stream, ['sharia', 'sharia plus', 'bayyinath'])) {
            $senderRole = 'boys_admin';
        }

        $notifications = $senderRole
            ? \App\Models\TalentsMeetNotification::where('sender_role', $senderRole)->latest()->get()
            : collect();

        return view('institution.talents-meet.index', compact('meets', 'notifications'));
    }

    /**
     * Show the form for creating a new weekly talents meet program.
     */
    public function create()
    {
        return view('institution.talents-meet.create');
    }

    /**
     * Store a newly created weekly talents meet program in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meet_date' => 'required|date',
            'qiraath' => 'nullable|string|max:255',
            'presidential_address' => 'nullable|string|max:255',
            'inauguration_talk' => 'nullable|string|max:255',
            'welcome_speech' => 'nullable|string|max:255',
            'speeches' => 'nullable|string',
            'songs' => 'nullable|string',
            'vote_of_thanks' => 'nullable|string|max:255',
        ]);

        $institution = auth()->guard('institution')->user();

        $institution->weeklyTalentsMeets()->create($request->all());

        return redirect()->route('institution.talents-meet.index')
            ->with('success', 'Weekly Talents Meet program list created successfully.');
    }

    /**
     * Display the specified weekly talents meet program.
     */
    public function show(WeeklyTalentsMeet $talentsMeet)
    {
        $institution = auth()->guard('institution')->user();

        if ($talentsMeet->institution_id !== $institution->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('institution.talents-meet.show', compact('talentsMeet'));
    }

    /**
     * Show the form for editing the specified weekly talents meet program.
     */
    public function edit(WeeklyTalentsMeet $talentsMeet)
    {
        $institution = auth()->guard('institution')->user();

        if ($talentsMeet->institution_id !== $institution->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('institution.talents-meet.edit', compact('talentsMeet'));
    }

    /**
     * Update the specified weekly talents meet program in storage.
     */
    public function update(Request $request, WeeklyTalentsMeet $talentsMeet)
    {
        $institution = auth()->guard('institution')->user();

        if ($talentsMeet->institution_id !== $institution->id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'meet_date' => 'required|date',
            'qiraath' => 'nullable|string|max:255',
            'presidential_address' => 'nullable|string|max:255',
            'inauguration_talk' => 'nullable|string|max:255',
            'welcome_speech' => 'nullable|string|max:255',
            'speeches' => 'nullable|string',
            'songs' => 'nullable|string',
            'vote_of_thanks' => 'nullable|string|max:255',
        ]);

        $talentsMeet->update($request->all());

        return redirect()->route('institution.talents-meet.index')
            ->with('success', 'Weekly Talents Meet program list updated successfully.');
    }

    /**
     * Remove the specified weekly talents meet program from storage.
     */
    public function destroy(WeeklyTalentsMeet $talentsMeet)
    {
        $institution = auth()->guard('institution')->user();

        if ($talentsMeet->institution_id !== $institution->id) {
            abort(403, 'Unauthorized action.');
        }

        $talentsMeet->delete();

        return redirect()->route('institution.talents-meet.index')
            ->with('success', 'Weekly Talents Meet program list deleted successfully.');
    }
}
