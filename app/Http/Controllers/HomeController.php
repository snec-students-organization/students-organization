<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UpcomingEvent;
use App\Models\GalleryEvent;
use App\Models\AdmissionData;

class HomeController extends Controller
{
  

public function index()
{
    $upcomingEvents = UpcomingEvent::where('event_date', '>=', now())
        ->orderBy('event_date')
        ->limit(3)
        ->get();

    // Fetch marked gallery events
    $markedGalleryEvents = GalleryEvent::where('marked', true)
        ->orderBy('date')
        ->get();

    // Fetch latest admin notifications
    $notifications = \App\Models\Notification::latest()
        ->take(5) // adjust the number of notifications you want
        ->get();

    return view('home', compact('upcomingEvents', 'markedGalleryEvents', 'notifications'));
}

public function admissionCampaign()
{
    return view('admission-campaign');
}

    public function submitAdmissionData(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'uid_no' => 'required|string|max:50',
            'college_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'application_number' => 'required|string|max:100|unique:admission_data,application_number',
        ], [
            'application_number.unique' => 'This application number has already been submitted.',
        ]);

        $validated['scratch_card_amount'] = rand(10, 30);

        $admission = \App\Models\AdmissionData::create($validated);

        return back()
            ->with('success', 'Admission data submitted successfully!')
            ->with('scratch_card_amount', $admission->scratch_card_amount)
            ->with('admission_id', $admission->id);
    }

    public function claimScratchCard(Request $request)
    {
        $validated = $request->validate([
            'admission_id' => 'required|exists:admission_data,id',
            'gpay_number' => 'required|string|max:20',
        ]);

        $admission = \App\Models\AdmissionData::findOrFail($validated['admission_id']);
        
        $updated = $admission->update([
            'is_scratched' => true,
            'gpay_number' => $validated['gpay_number'],
        ]);

        // Temporary log for debugging
        file_put_contents(storage_path('logs/claim_debug.log'), 
            date('Y-m-d H:i:s') . " - ID: " . $validated['admission_id'] . " - GPay: " . $validated['gpay_number'] . " - Updated: " . ($updated ? 'Yes' : 'No') . "\n", 
            FILE_APPEND);

        return response()->json([
            'success' => $updated, 
            'message' => $updated ? 'Reward claimed successfully!' : 'Failed to update record.'
        ]);
    }

}
