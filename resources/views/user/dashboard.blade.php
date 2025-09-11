@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Welcome Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-primary fw-bold">Welcome, {{ auth()->user()->name }}</h1>
        <div class="badge bg-light text-dark p-2">
            <i class="fas fa-calendar-alt me-2"></i>{{ now()->format('l, F j, Y') }}
        </div>
    </div>

    {{-- Membership Status Message --}}
    @if(isset($message))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @else
        <div class="alert alert-secondary" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>No membership status available.
        </div>
    @endif

    {{-- Quick Links --}}
    <div class="row g-3 mt-4 mb-5">
        <div class="col-md-3 col-6">
            <a href="{{ route('calendar') }}" class="card text-center shadow-sm h-100 quick-link-card">
                <div class="card-body p-4">
                    <div class="quick-link-icon mb-3">
                        <i class="fas fa-calendar-day fa-2x text-primary"></i>
                    </div>
                    <h5 class="card-title">Events</h5>
                    <p class="text-muted small">View upcoming events</p>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="{{ route('gallery.index') }}" class="card text-center shadow-sm h-100 quick-link-card">
                <div class="card-body p-4">
                    <div class="quick-link-icon mb-3">
                        <i class="fas fa-images fa-2x text-success"></i>
                    </div>
                    <h5 class="card-title">Gallery</h5>
                    <p class="text-muted small">Browse photos</p>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="{{ route('committees.index') }}" class="card text-center shadow-sm h-100 quick-link-card">
                <div class="card-body p-4">
                    <div class="quick-link-icon mb-3">
                        <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                    <h5 class="card-title">Committees</h5>
                    <p class="text-muted small">Explore committees</p>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="{{ route('notifications.index') }}" class="card text-center shadow-sm h-100 quick-link-card">
                <div class="card-body p-4">
                    <div class="quick-link-icon mb-3">
                        <i class="fas fa-bell fa-2x text-warning"></i>
                    </div>
                    <h5 class="card-title">Notifications</h5>
                    <p class="text-muted small">Check updates</p>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-6">
            <a href="{{ route('payments.user.create') }}" class="card text-center shadow-sm h-100 quick-link-card">
                <div class="card-body p-4">
                    <div class="quick-link-icon mb-3">
                        <i class="fas fa-credit-card fa-2x text-danger"></i>
                    </div>
                    <h5 class="card-title">Working Fund</h5>
                    <p class="text-muted small">Make payment</p>
                </div>
            </a>
        </div>
    </div>

    {{-- Upcoming Events Section --}}
    <section id="events" class="section-padding">
        <div class="container-fluid px-0">
            <div class="text-center mb-5">
                <h2 class="section-title position-relative d-inline-block">Upcoming Events</h2>
                <p class="section-subtitle text-muted">Don't miss these exciting upcoming events</p>
            </div>
            
            @if($upcomingEvents->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No upcoming events</h4>
                    <p class="text-muted">Check back later for new events</p>
                </div>
            @else
                <div class="row" id="upcoming-events">
                    @foreach($upcomingEvents as $event)
                        <div class="col-md-4 mb-4">
                            <div class="card event-card h-100 shadow-sm border-0">
                                <div class="event-image-container">
                                    @if($event->image)
                                        <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top event-image" alt="{{ $event->title }}">
                                    @else
                                        <div class="card-img-top event-image-placeholder d-flex align-items-center justify-content-center">
                                            <i class="fas fa-calendar-alt fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                    <div class="event-date-badge">
                                        @if($event->date)
                                            <span class="badge bg-primary">
                                                {{ $event->date->format('M j') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">{{ $event->title }}</h5>
                                    <div class="event-details mb-3">
                                        @if($event->date)
                                            <div class="d-flex align-items-center mb-1">
                                                <i class="far fa-calendar text-primary me-2"></i>
                                                <span>{{ $event->date->format('F j, Y') }}</span>
                                            </div>
                                        @endif
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                            <span>{{ $event->location ?? 'TBA' }}</span>
                                        </div>
                                    </div>
                                    @if($event->description)
                                        <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
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
            
            <div class="text-center mt-5">
                <a href="{{ url('/calendar') }}" class="btn btn-primary px-4 py-2">
                    <i class="fas fa-calendar me-2"></i>View All Events
                </a>
            </div>
        </div>
    </section>
</div>

<style>
    .quick-link-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        border: none;
        text-decoration: none !important; /* Add this line */
    }
    
    .quick-link-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        text-decoration: none !important; /* Add this line */
    }
    
    .quick-link-icon {
        width: 60px;
        height: 60px;
        line-height: 60px;
        border-radius: 50%;
        background-color: rgba(59, 89, 152, 0.1);
        margin: 0 auto;
    }
    
    .section-title {
        font-weight: 700;
        color: #2c3e50;
    }
    
    .section-title:after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background: var(--primary);
        margin: 10px auto;
    }
    
    .event-card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    
    .event-card:hover {
        transform: translateY(-5px);
    }
    
    .event-image-container {
        position: relative;
        overflow: hidden;
        height: 200px;
    }
    
    .event-image {
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .event-card:hover .event-image {
        transform: scale(1.05);
    }
    
    .event-image-placeholder {
        height: 200px;
        background-color: #f8f9fa;
    }
    
    .event-date-badge {
        position: absolute;
        top: 15px;
        right: 15px;
    }
    
    .alert {
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
   
    
    .quick-link-card:focus {
        text-decoration: none !important; /* Add this line */
    }
</style>
@endsection