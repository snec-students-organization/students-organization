<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UpcomingEvent;
use App\Models\GalleryEvent;

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


}


