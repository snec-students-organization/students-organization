<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Event;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Show list of notifications for admin management
    public function index()
    {
        $notifications = Notification::latest()->paginate(15);
        return view('admin.notifications.index', compact('notifications'));
    }

    // Show create notification form
    public function create()
{
    $events = Event::orderBy('date', 'asc')->get();
    return view('admin.notifications.create', compact('events'));
}


    // Store newly created notification
    public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'message' => 'nullable|string',
        'pdf' => 'nullable|file|mimes:pdf|max:2048',
        'user_type' => 'required|in:public,user,admin',
        'event_id' => 'nullable|exists:events,id',
    ]);

    if ($request->hasFile('pdf')) {
        $data['pdf_path'] = $request->file('pdf')->store('notifications_pdfs', 'public');
    }

    Notification::create($data);

    return redirect()->route('admin.notifications.index')->with('success', 'Notification created successfully.');
}


    // Show edit form for notification
    public function edit(Notification $notification)
    {
        $events = Event::orderBy('date', 'asc')->get();
        return view('admin.notifications.edit', compact('notification', 'events'));
    }

    // Update notification
    public function update(Request $request, Notification $notification)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'nullable|string',
            'pdf' => 'nullable|file|mimes:pdf|max:2048',
            'user_type' => 'required|in:public,user,admin',
            'event_id' => 'nullable|exists:events,id',
        ]);

        if ($request->hasFile('pdf')) {
            // Optionally delete old PDF here if you want
            $data['pdf_path'] = $request->file('pdf')->store('notifications_pdfs', 'public');
        }

        $notification->update($data);

        return redirect()->route('admin.notifications.index')->with('success', 'Notification updated successfully.');
    }

    // Delete notification
    public function destroy(Notification $notification)
{
    // Delete associated PDF file from storage if exists
    if ($notification->pdf_path && \Storage::disk('public')->exists($notification->pdf_path)) {
        \Storage::disk('public')->delete($notification->pdf_path);
    }

    $notification->delete();

    return redirect()->route('admin.notifications.index')->with('success', 'Notification deleted successfully.');
}

}
