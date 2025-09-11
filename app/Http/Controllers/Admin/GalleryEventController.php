<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryEventController extends Controller
{
    public function index()
{
    $events = GalleryEvent::all(); // or paginate()
    return view('admin.gallery-events.index', compact('events'));
}


    public function create()
    {
        return view('admin.gallery-events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('events', 'public');
        }

        GalleryEvent::create($data);

        return redirect()->route('admin.gallery-events.index')->with('success', 'Event created successfully.');
    }

    public function edit(GalleryEvent $galleryEvent)
    {
        return view('admin.gallery-events.edit', compact('galleryEvent'));
    }

    public function update(Request $request, GalleryEvent $galleryEvent)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($galleryEvent->cover_image) {
                Storage::disk('public')->delete($galleryEvent->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('events', 'public');
        }

        $galleryEvent->update($data);

        return redirect()->route('admin.gallery-events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(GalleryEvent $galleryEvent)
    {
        if ($galleryEvent->cover_image) {
            Storage::disk('public')->delete($galleryEvent->cover_image);
        }
        $galleryEvent->delete();

        return redirect()->route('admin.gallery-events.index')->with('success', 'Event deleted successfully.');
    }
    public function toggleMark($id)
{
    $event = GalleryEvent::findOrFail($id);
    $event->marked = !$event->marked;
    $event->save();
    return redirect()->back()->with('success', 'Event mark status updated.');
}
    
    

}
