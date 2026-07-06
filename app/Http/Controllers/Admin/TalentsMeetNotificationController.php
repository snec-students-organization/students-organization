<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TalentsMeetNotification;
use Illuminate\Http\Request;

class TalentsMeetNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Store a newly created talents meet notification.
     */
    public function store(Request $request)
    {
        $request->validate([
            'topic' => 'required|string|max:255',
            'description' => 'required|string',
            'sender_role' => 'required|string|in:boys_admin,girls_admin',
        ]);

        $user = auth()->user();
        $senderRole = $user->role;

        // If super admin, they can post as either role depending on which dashboard they are on
        if ($senderRole === 'admin') {
            $senderRole = $request->input('sender_role');
        }

        // Verify role permission
        if (!in_array($senderRole, ['boys_admin', 'girls_admin'])) {
            return redirect()->back()->with('error', 'Unauthorized to send notifications for this role.');
        }

        TalentsMeetNotification::create([
            'sender_id' => $user->id,
            'sender_role' => $senderRole,
            'topic' => $request->topic,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Notification sent successfully.');
    }

    /**
     * Remove the specified notification from storage.
     */
    public function destroy(TalentsMeetNotification $notification)
    {
        $user = auth()->user();

        // Check if user has permission to delete this notification
        if ($user->role !== 'admin' && $user->role !== $notification->sender_role) {
            abort(403, 'Unauthorized to delete this notification.');
        }

        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }
}
