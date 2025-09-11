<?php

namespace App\Http\Controllers;

use App\Models\GalleryEvent;
use App\Models\EventImage; // ✅ Import the EventImage model
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Show all events in the gallery.
     */
    public function index()
    {
        $events = GalleryEvent::latest()->get();
        return view('gallery.index', compact('events'));
    }

    /**
     * Show a single event with its images.
     */
    public function show($eventId)
    {
        // Get the event
        $event = GalleryEvent::findOrFail($eventId);

        // Get all images for this event
        $images = EventImage::where('gallery_event_id', $eventId)->get();

        // Pass both variables to the view
        return view('gallery.show', compact('event', 'images'));
    }
}