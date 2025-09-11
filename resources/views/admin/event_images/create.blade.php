@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 p-3 bg-primary text-white rounded shadow-sm">
        <h1 class="h4 mb-2 mb-sm-0">
            <i class="bi bi-image me-2"></i> Add Image to Event: {{ $event->name }}
        </h1>
        <a href="{{ route('admin.gallery-events.images.index', $event->id) }}" class="btn btn-outline-light btn-sm shadow-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Back
        </a>
    </div>

    {{-- Form Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.gallery-events.images.store', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Image Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter image title" required>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Image Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" placeholder="Optional description..."></textarea>
                </div>

                {{-- Image Upload --}}
                <div class="mb-3">
                    <label for="image_path" class="form-label fw-semibold">Upload Image</label>
                    <input type="file" name="image_path" id="image_path" class="form-control" accept="image/*" required>
                    <div class="form-text">Accepted formats: JPG, PNG, GIF. Max size: 2MB</div>
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-upload me-1"></i> Upload Image
                    </button>
                    <a href="{{ route('admin.gallery-events.images.index', $event->id) }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection