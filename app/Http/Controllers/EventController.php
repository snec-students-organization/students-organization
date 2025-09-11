<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
 use App\Models\Notification; // Add this use statement at the top

class EventController extends Controller
{
    // Calendar View for Users
    public function index()
    {
        $events = Event::orderBy('start', 'asc')->get();

        // Count events for this month
        $eventsThisMonth = Event::whereMonth('start', now()->month)
            ->whereYear('start', now()->year)
            ->count();

        // Count upcoming events (today and future)
        $upcomingEvents = Event::where('start', '>=', now())->count();

        return view('calendar', compact('events', 'eventsThisMonth', 'upcomingEvents'));
    }

    // Admin - All Events
    public function adminIndex()
    {
        $events = Event::latest()->get();
        $latestLogs = $this->getLatestActivityLogs(); // ✅ Fetch latest activity logs
        return view('admin.events.index', compact('events', 'latestLogs'));
    }

    // Fetch events for calendar (API)
    public function fetch()
    {
        $events = Event::select('id', 'title', 'start', 'end', 'description')->get();
        return response()->json($events);
    }

    // Admin - Create event form
    public function create()
    {
        return view('admin.events.create');
    }

    // Admin - Store event
  
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'start' => 'required|date',
        'end' => 'required|date|after_or_equal:start',
        'description' => 'nullable|string'
    ]);

    $event = Event::create($request->only(['title', 'start', 'end', 'description']));

    // Create notification visible to public and users about the new event
    Notification::create([
        'title' => "New Event: {$event->title}",
        'message' => $event->description,
        'user_type' => 'public', // Visible to guests/public and users (depending on your logic)
        'event_id' => $event->id,
        'read_at' => null,
    ]);

    $this->logActivity('Created event: ' . $event->title);

    return redirect()->route('admin.events.create')->with('success', 'Event created successfully!');
}





    // Edit & Update
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'description' => 'nullable|string'
        ]);

        $event->update($request->only(['title', 'start', 'end', 'description']));

        $this->logActivity('Updated event: ' . $event->title);

        return redirect()->route('admin.events.create')->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        $eventTitle = $event->title;
        $event->delete();

        $this->logActivity('Deleted event: ' . $eventTitle);

        return back()->with('success', 'Event deleted successfully!');
    }

    /**
     * ✅ Log user activity
     */
    private function logActivity(string $description)
    {
        ActivityLog::create([
    'user_id' => Auth::user()->id,  // Force numeric PK
    'description' => $description
]);

    }

    /**
     * ✅ Fetch latest activity logs (for dashboard or admin view)
     */
    private function getLatestActivityLogs($limit = 5)
    {
        return ActivityLog::with('user:id,name') // Eager load user name
            ->latest()
            ->take($limit)
            ->get();
    }
    public function show(Event $event)
{
    // Eager load images if your Event model has a relationship
    $event->load('images');

    return view('events.show', [
        'event' => $event,
        'images' => $event->images
    ]);
}



}
