@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 p-3 bg-primary text-white rounded shadow-sm">
        <h1 class="h4 mb-2 mb-sm-0">
            <i class="bi bi-pencil-square me-2"></i> Edit Event: {{ $galleryEvent->name }}
        </h1>
        <a href="{{ route('admin.gallery-events.index') }}" class="btn btn-outline-light btn-sm shadow-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Back
        </a>
    </div>

    {{-- Edit Form Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.gallery-events.update', $galleryEvent->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Event Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Event Name</label>
                    <input type="text" name="name" id="name" 
                           value="{{ old('name', $galleryEvent->name) }}" 
                           class="form-control" placeholder="Enter event name" required>
                </div>

                {{-- Cover Image --}}
                <div class="mb-3">
                    <label for="cover_image" class="form-label fw-semibold">Cover Image (optional)</label>
                    <input type="file" name="cover_image" id="cover_image" 
                           class="form-control" accept="image/*">
                    <div class="form-text">Leave blank to keep the current image.</div>

                    @if($galleryEvent->cover_image)
                        <div class="mt-3">
                            <p class="fw-semibold mb-1">Current Image:</p>
                            <img src="{{ asset('storage/' . $galleryEvent->cover_image) }}" 
                                 alt="{{ $galleryEvent->name }}" 
                                 class="rounded shadow-sm border" 
                                 style="max-width: 200px; height: auto;">
                        </div>
                    @endif
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i> Update Event
                    </button>
                    <a href="{{ route('admin.gallery-events.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection