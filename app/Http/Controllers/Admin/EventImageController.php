<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventImage;
use App\Models\GalleryEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventImageController extends Controller
{
   

public function index($galleryEventId)
{
    $event = GalleryEvent::findOrFail($galleryEventId);
    $images = $event->images()->paginate(12);  // or get()

    return view('admin.event_images.index', compact('event', 'images'));
}





    public function create($eventId)
    {
        $event = GalleryEvent::findOrFail($eventId);
        return view('admin.event_images.create', compact('event'));
    }

    public function store(Request $request, $eventId)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('event_images', 'public');
        }

        $data['gallery_event_id'] = $eventId;

        EventImage::create($data);

        return redirect()->route('admin.gallery-events.images.index', $eventId)
                         ->with('success', 'Image uploaded successfully.');
    }

    public function edit($eventId, $imageId)
    {
        $event = GalleryEvent::findOrFail($eventId);
        $image = EventImage::findOrFail($imageId);
        return view('admin.event_images.edit', compact('event', 'image'));
    }

    public function update(Request $request, $eventId, $imageId)
    {
        $image = EventImage::findOrFail($imageId);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image_path')) {
            // Delete old image
            if ($image->image_path) {
                Storage::disk('public')->delete($image->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('event_images', 'public');
        }

        $image->update($data);

        return redirect()->route('admin.gallery-events.images.index', $eventId)
                         ->with('success', 'Image updated successfully.');
    }

    public function destroy($eventId, $imageId)
    {
        $image = EventImage::findOrFail($imageId);

        if ($image->image_path) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return redirect()->route('admin.gallery-events.images.index', $eventId)
                         ->with('success', 'Image deleted successfully.');
    }
    public function toggleMark($eventId, $imageId)
{
    $image = EventImage::findOrFail($imageId);
    $image->marked = !$image->marked;
    $image->save();

    return redirect()->back()->with('success', 'Image mark status updated.');
}

    


    

}