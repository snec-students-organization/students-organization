<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Show all notifications for current user or public
    public function index()
    {
        $user = Auth::user();

        $notifications = Notification::where(function ($query) use ($user) {
            if ($user) {
                $query->whereIn('user_type', ['user', 'public']);
            } else {
                $query->where('user_type', 'public');
            }
        })
        ->orderBy('created_at', 'desc')
        ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    // Mark a notification as read via AJAX or standard post
   public function markAsRead(Notification $notification)
{
    // Ensure user can mark this notification read; customize authorization as needed
    $notification->update(['read_at' => now()]);

    // Return a response (JSON or redirect back)
    return back()->with('success', 'Notification marked as read.');
}

public function destroy(Notification $notification)
{
    // Ensure user can delete this notification; customize authorization as needed
    $notification->delete();

    return back()->with('success', 'Notification deleted successfully.');
}

}
