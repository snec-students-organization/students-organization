@php
    $isEdit = isset($event);
@endphp

<form action="{{ $isEdit ? route('admin.upcoming-events.update', $event) : route('admin.upcoming-events.store') }}" 
      method="POST" enctype="multipart/form-data">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    {{-- Event Title --}}
    <div class="mb-3">
        <label for="title" class="form-label fw-semibold">
            <i class="bi bi-type me-1"></i> Event Title
        </label>
        <input type="text" name="title" id="title" 
               class="form-control" 
               value="{{ old('title', $isEdit ? $event->title : '') }}" 
               placeholder="Enter event title" required>
    </div>

    {{-- Event Date --}}
    <div class="mb-3">
        <label for="date" class="form-label fw-semibold">
            <i class="bi bi-calendar-event me-1"></i> Event Date
        </label>
        <input type="date" name="event_date" id="date" 
               class="form-control" 
               value="{{ old('event_date', $isEdit ? $event->date->format('Y-m-d') : '') }}" required>
    </div>

    {{-- Location --}}
    <div class="mb-3">
        <label for="location" class="form-label fw-semibold">
            <i class="bi bi-geo-alt-fill me-1"></i> Location
        </label>
        <input type="text" name="location" id="location" 
               class="form-control" 
               value="{{ old('location', $isEdit ? $event->location : '') }}" 
               placeholder="Enter event location" required>
    </div>

    {{-- Description --}}
    <div class="mb-3">
        <label for="description" class="form-label fw-semibold">
            <i class="bi bi-card-text me-1"></i> Description (optional)
        </label>
        <textarea name="description" id="description" 
                  class="form-control" rows="4" 
                  placeholder="Enter event description...">{{ old('description', $isEdit ? $event->description : '') }}</textarea>
    </div>

    {{-- Event Photo --}}
    <div class="mb-3">
        <label for="image" class="form-label fw-semibold">
            <i class="bi bi-image-fill me-1"></i> Event Photo
        </label>
        <input type="file" name="image" id="image" 
               class="form-control" {{ $isEdit ? '' : 'required' }}>
        <div class="form-text">Accepted formats: JPG, PNG. Max size: 2MB</div>

        @if($isEdit && $event->image)
            <div class="mt-2 p-2 bg-light border rounded d-inline-block">
                <img src="{{ asset('storage/' . $event->image) }}" 
                     alt="Event photo" class="img-fluid rounded" style="max-width: 150px;">
            </div>
        @endif
    </div>

    {{-- Submit Button --}}
    <button type="submit" class="btn btn-success">
        <i class="bi {{ $isEdit ? 'bi-check-circle' : 'bi-plus-circle' }} me-1"></i>
        {{ $isEdit ? 'Update Event' : 'Add Event' }}
    </button>
</form>