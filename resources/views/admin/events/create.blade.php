@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><i class="bi bi-calendar-plus me-2"></i>Add New Event</h4>
                        <span class="badge bg-light text-primary">Admin</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>Please fix the following issues:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.events.store') }}" id="eventForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">
                                Event Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" id="title" class="form-control" required 
                                value="{{ old('title') }}" placeholder="Enter event title">
                            <div class="form-text">Give your event a clear and descriptive title.</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start" class="form-label fw-semibold">
                                    Start Date & Time <span class="text-danger">*</span>
                                </label>
                                <input type="datetime-local" name="start" id="start" class="form-control" required 
                                    value="{{ old('start') }}">
                                <div class="form-text">When does the event begin?</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="end" class="form-label fw-semibold">
                                    End Date & Time <span class="text-danger">*</span>
                                </label>
                                <input type="datetime-local" name="end" id="end" class="form-control" required 
                                    value="{{ old('end') }}">
                                <div class="form-text">When does the event conclude?</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label fw-semibold">Location</label>
                            <input type="text" name="location" id="location" class="form-control" 
                                value="{{ old('location') }}" placeholder="Enter event location (optional)">
                            <div class="form-text">Physical location or online meeting link.</div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea name="description" id="description" rows="4" class="form-control" 
                                placeholder="Enter event description (optional)">{{ old('description') }}</textarea>
                            <div class="form-text">Provide details about the event agenda, speakers, or special instructions.</div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_public" name="is_public" value="1" 
                                    {{ old('is_public') ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_public">
                                    Public Event
                                </label>
                            </div>
                            <div class="form-text">If enabled, this event will be visible to all users.</div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Back to Events
                            </a>
                            <div>
                                <button type="reset" class="btn btn-outline-danger me-2">
                                    <i class="bi bi-x-circle me-1"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-calendar-check me-1"></i> Save Event
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum datetime for start and end fields to current time
    const now = new Date();
    const timezoneOffset = now.getTimezoneOffset() * 60000; // offset in milliseconds
    const localISOTime = new Date(now - timezoneOffset).toISOString().slice(0, 16);
    
    document.getElementById('start').min = localISOTime;
    document.getElementById('end').min = localISOTime;
    
    // Validate end date is after start date
    const form = document.getElementById('eventForm');
    form.addEventListener('submit', function(e) {
        const start = new Date(document.getElementById('start').value);
        const end = new Date(document.getElementById('end').value);
        
        if (end <= start) {
            e.preventDefault();
            alert('End date and time must be after the start date and time.');
            return false;
        }
    });
    
    // Auto-set end date to 1 hour after start date
    document.getElementById('start').addEventListener('change', function() {
        const startValue = this.value;
        if (startValue) {
            const startDate = new Date(startValue);
            const endDate = new Date(startDate.getTime() + 60 * 60 * 1000); // Add 1 hour
            const endISOTime = new Date(endDate - timezoneOffset).toISOString().slice(0, 16);
            
            document.getElementById('end').value = endISOTime;
            document.getElementById('end').min = startValue;
        }
    });
});
</script>
@endsection
