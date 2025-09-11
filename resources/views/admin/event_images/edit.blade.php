@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 p-3 bg-primary text-white rounded shadow-sm">
        <h1 class="h4 mb-2 mb-sm-0">
            <i class="bi bi-pencil-square me-2"></i> Edit Image: {{ $image->title }}
        </h1>
        <a href="{{ route('admin.gallery-events.images.index', $event->id) }}" class="btn btn-outline-light btn-sm shadow-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Back
        </a>
    </div>

    {{-- Edit Form Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.gallery-events.images.update', [$event->id, $image->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Title</label>
                    <input type="text" name="title" id="title" 
                           value="{{ old('title', $image->title) }}" 
                           class="form-control" placeholder="Enter image title" required>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Description (optional)</label>
                    <textarea name="description" id="description" 
                              class="form-control" rows="3" 
                              placeholder="Enter a short description...">{{ old('description', $image->description) }}</textarea>
                </div>

                {{-- Image Upload --}}
                <div class="mb-3">
                    <label for="image_path" class="form-label fw-semibold">Replace Image (optional)</label>
                    <input type="file" name="image_path" id="image_path" 
                           class="form-control" accept="image/*">
                    <div class="form-text">Leave blank to keep the current image.</div>

                    @if($image->image_path)
                        <div class="mt-3">
                            <p class="fw-semibold mb-1">Current Image:</p>
                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                 alt="{{ $image->title }}" 
                                 class="rounded shadow-sm border" 
                                 style="max-width: 200px; height: auto;">
                        </div>
                    @endif
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i> Update Image
                    </button>
                    <a href="{{ route('admin.gallery-events.images.index', $event->id) }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection