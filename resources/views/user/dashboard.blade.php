@extends('layouts.app')

@section('content')


<div class="container py-4">
    <!-- Welcome Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-primary fw-bold mb-1">Welcome, {{ auth()->user()->name }}</h1>
            <p class="text-muted mb-0">Here's your membership status and upcoming events</p>
        </div>
        <div class="badge bg-light text-dark p-2">
            <i class="fas fa-calendar-alt me-2"></i>{{ now()->format('l, F j, Y') }}
        </div>
    </div>

    {{-- Membership Status Message --}}
    @if(isset($message))
        <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @else
        <div class="alert alert-secondary mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>No membership status available.
        </div>
    @endif

    <div class="row">
        {{-- Membership Card --}}
        <div class="col-lg-4 mb-4">
    @if($student && $student->status === 'verified')
    <div class="card shadow-sm border-0 h-100">
        <div class="card-header bg-white border-0 pb-0">
            <h5 class="card-title fw-bold">Membership Card</h5>
        </div>
        <div class="card-body text-center">
            <span class="badge bg-success px-3 py-2 mb-3">
                <i class="fas fa-check-circle me-1"></i> Verified Member
            </span>
            <h5 class="fw-bold">{{ $student->name }}</h5>
            <p class="text-muted mb-1">UID: {{ $student->uid }}</p>
            <p class="fw-bold text-dark">College: {{ $student->institution->name ?? 'N/A' }}</p>
            
            <div class="border p-3 rounded-3 bg-light mt-3">
                <h6 class="mb-1">Membership Number</h6>
                <p class="fw-bold text-primary fs-5">{{ $student->membership_number }}</p>
            </div>

            <!-- New Details -->
            <div class="mt-3 text-start">
                <p class="mb-1"><strong>Stream:</strong> {{ ucfirst(str_replace('_', ' ', $student->stream)) }}</p>
                <p class="mb-1"><strong>Class:</strong> {{ strtoupper($student->class) }}</p>
                <p class="mb-0"><strong>Address:</strong> {{ $student->address }}</p>
            </div>

            <a href="{{ route('membership.download') }}" class="btn btn-outline-primary w-100 mt-3">
                <i class="fas fa-download me-1"></i> Download Card
            </a>
        </div>
    </div>
    @endif
</div>


        {{-- Quick Links --}}
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="card-title fw-bold">Quick Access</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4 col-6">
                            <a href="{{ route('calendar') }}" class="card text-center shadow-sm h-100 quick-link-card text-decoration-none">
                                <div class="card-body p-3">
                                    <div class="quick-link-icon mb-2 text-primary">
                                        <i class="fas fa-calendar-day fa-2x"></i>
                                    </div>
                                    <h6 class="card-title mb-1">Events</h6>
                                    <p class="text-muted small mb-0">View upcoming events</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-6">
                            <a href="{{ route('gallery.index') }}" class="card text-center shadow-sm h-100 quick-link-card text-decoration-none">
                                <div class="card-body p-3">
                                    <div class="quick-link-icon mb-2 text-success">
                                        <i class="fas fa-images fa-2x"></i>
                                    </div>
                                    <h6 class="card-title mb-1">Gallery</h6>
                                    <p class="text-muted small mb-0">Browse photos</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-6">
                            <a href="{{ route('committees.index') }}" class="card text-center shadow-sm h-100 quick-link-card text-decoration-none">
                                <div class="card-body p-3">
                                    <div class="quick-link-icon mb-2 text-info">
                                        <i class="fas fa-users fa-2x"></i>
                                    </div>
                                    <h6 class="card-title mb-1">Committees</h6>
                                    <p class="text-muted small mb-0">Explore committees</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-6">
                            <a href="{{ route('notifications.index') }}" class="card text-center shadow-sm h-100 quick-link-card text-decoration-none">
                                <div class="card-body p-3">
                                    <div class="quick-link-icon mb-2 text-warning">
                                        <i class="fas fa-bell fa-2x"></i>
                                    </div>
                                    <h6 class="card-title mb-1">Notifications</h6>
                                    <p class="text-muted small mb-0">Check updates</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-6">
                            <a href="{{ route('payments.user.create') }}" class="card text-center shadow-sm h-100 quick-link-card text-decoration-none">
                                <div class="card-body p-3">
                                    <div class="quick-link-icon mb-2 text-danger">
                                        <i class="fas fa-credit-card fa-2x"></i>
                                    </div>
                                    <h6 class="card-title mb-1">Working Fund</h6>
                                    <p class="text-muted small mb-0">Make payment</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-6">
                    <a href="/user/submit-data" class="card text-center shadow-sm h-100 quick-link-card text-decoration-none">
                        <div class="card-body p-3">
                            <div class="quick-link-icon mb-2 text-purple">
                                <i class="fas fa-cloud-upload-alt fa-2x"></i>
                            </div>
                            <h6 class="card-title mb-1">Submit Data</h6>
                            <p class="text-muted small mb-0">Upload information</p>
                        </div>
                    </a>
                </div>
                        <div class="col-md-4 col-6">
                            <div class="card text-center shadow-sm h-100 bg-light border-0">
                                <div class="card-body p-3 d-flex align-items-center justify-content-center">
                                    <p class="text-muted small mb-0">More options coming soon</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Upcoming Events Section --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0">
            <h5 class="card-title fw-bold mb-0">Upcoming Events</h5>
        </div>
        <div class="card-body">
            @if($upcomingEvents->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No upcoming events</h4>
                    <p class="text-muted">Check back later for new events</p>
                </div>
            @else
                <div class="row">
                    @foreach($upcomingEvents as $event)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="position-relative">
                                    @if($event->image)
                                        <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->title }}" style="height: 180px; object-fit: cover;">
                                    @else
                                        <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 180px;">
                                            <i class="fas fa-calendar-alt fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                    @if($event->date)
                                        <span class="position-absolute top-0 end-0 m-2 badge bg-primary">
                                            {{ $event->date->format('M j') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">{{ $event->title }}</h6>
                                    <div class="event-details mb-2">
                                        @if($event->date)
                                            <div class="d-flex align-items-center mb-1">
                                                <i class="far fa-calendar text-primary me-2 fa-sm"></i>
                                                <small>{{ $event->date->format('F j, Y') }}</small>
                                            </div>
                                        @endif
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-map-marker-alt text-danger me-2 fa-sm"></i>
                                            <small>{{ $event->location ?? 'TBA' }}</small>
                                        </div>
                                    </div>
                                    @if($event->description)
                                        <p class="card-text text-muted small">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                                    @endif
                                </div>
                                <div class="card-footer bg-transparent border-0 pt-0">
                                    <a href="#" class="btn btn-outline-primary btn-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            
            <div class="text-center mt-4">
                <a href="{{ url('/calendar') }}" class="btn btn-primary px-4">
                    <i class="fas fa-calendar me-2"></i>View All Events
                </a>
            </div>
        </div>
    </div>
</div>
@section('styles')
<link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}">
@endsection

@endsection