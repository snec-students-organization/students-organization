<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UpcomingEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpcomingEventController extends Controller
{
    public function index()
    {
        $events = UpcomingEvent::all();
        return view('admin.upcoming-events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.upcoming-events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('upcoming_events', 'public');
        }

        UpcomingEvent::create([
            'title' => $request->title,
            'event_date' => $request->input('event_date'),
            'location' => $request->location,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.upcoming-events.index')->with('success', 'Upcoming event added successfully.');
    }
    public function destroy($id)
{
    $event = \App\Models\UpcomingEvent::findOrFail($id);

    // Optionally, delete the image file from storage
    if ($event->image) {
        \Storage::disk('public')->delete($event->image);
    }

    $event->delete();

    return redirect()->route('admin.upcoming-events.index')->with('success', 'Event deleted successfully.');
}
public function edit($id)
{
    $event = UpcomingEvent::findOrFail($id);
    return view('admin.upcoming-events.edit', compact('event'));
}
public function update(Request $request, $id)
{
    $event = UpcomingEvent::findOrFail($id);

    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'event_date' => 'required|date',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        // Store new image
        $data['image'] = $request->file('image')->store('upcoming_events', 'public');
    }

    $event->update($data);

    return redirect()->route('admin.upcoming-events.index')->with('success', 'Event updated successfully.');
}





    // Add methods for edit, update, and destroy similarly
}
