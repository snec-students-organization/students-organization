@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 p-3 bg-primary text-white rounded shadow-sm">
        <h1 class="h4 mb-2 mb-sm-0">
            <i class="bi bi-bell-fill me-2"></i> Create Notification
        </h1>
        <a href="{{ route('admin.notifications.index') }}" class="btn btn-outline-light btn-sm shadow-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Back
        </a>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.notifications.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Notification Title</label>
                    <input type="text" id="title" name="title" 
                           class="form-control" value="{{ old('title') }}" 
                           placeholder="Enter notification title" required>
                </div>

                {{-- Message --}}
                <div class="mb-3">
                    <label for="message" class="form-label fw-semibold">Message (optional)</label>
                    <textarea id="message" name="message" 
                              class="form-control" rows="4" 
                              placeholder="Enter notification message...">{{ old('message') }}</textarea>
                </div>

                {{-- PDF Upload --}}
                <div class="mb-3">
                    <label for="pdf" class="form-label fw-semibold">Attach PDF (optional)</label>
                    <input type="file" id="pdf" name="pdf" 
                           accept="application/pdf" class="form-control">
                    <div class="form-text">Only PDF files are allowed. Max size: 2MB</div>
                </div>

                {{-- Visible To --}}
                <div class="mb-3">
                    <label for="user_type" class="form-label fw-semibold">Visible To</label>
                    <select id="user_type" name="user_type" class="form-select" required>
                        <option value="public" {{ old('user_type') == 'public' ? 'selected' : '' }}>Public</option>
                        <option value="user" {{ old('user_type') == 'user' ? 'selected' : '' }}>Authenticated Users</option>
                        <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admins Only</option>
                    </select>
                </div>

                {{-- Related Event --}}
                <div class="mb-3">
                    <label for="event_id" class="form-label fw-semibold">Related Event (optional)</label>
                    <select id="event_id" name="event_id" class="form-select">
                        <option value="">None</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                {{ $event->title }} — {{ $event->date ? $event->date->format('Y-m-d') : 'No Date' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-1"></i> Create Notification
                    </button>
                    <a href="{{ route('admin.notifications.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection