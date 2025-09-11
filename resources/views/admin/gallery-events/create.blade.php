@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 p-3 bg-primary text-white rounded shadow-sm">
        <h1 class="h4 mb-2 mb-sm-0">
            <i class="bi bi-calendar-plus me-2"></i> Create New Event
        </h1>
        <a href="{{ route('admin.gallery-events.index') }}" class="btn btn-outline-light btn-sm shadow-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Back
        </a>
    </div>

    {{-- Form Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.gallery-events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Event Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Event Name</label>
                    <input type="text" name="name" id="name" 
                           class="form-control" placeholder="Enter event name" required>
                </div>

                {{-- Cover Image --}}
                <div class="mb-3">
                    <label for="cover_image" class="form-label fw-semibold">Cover Image</label>
                    <input type="file" name="cover_image" id="cover_image" 
                           class="form-control" accept="image/*">
                    <div class="form-text">Optional — JPG, PNG, or GIF. Max size: 2MB</div>
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-1"></i> Create Event
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