@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-1 text-primary fw-bold"><i class="bi bi-calendar-event me-2"></i>Event Calendar</h2>
            <p class="text-muted mb-0">View and manage all upcoming events</p>
        </div>
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.events.create') }}" class="btn btn-success rounded-pill px-4">
                    <i class="bi bi-plus-circle me-1"></i> Add New Event
                </a>
            @endif
        @endauth
    </div>

    <!-- Stats Cards -->
    <div class="row mb-5">
        <div class="col-md-4 mb-3">
            <div class="card stats-card border-0 shadow-sm bg-gradient-primary">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="text-white-50 small">Total Events</span>
                            <h2 class="mb-0 text-white">{{ $events->count() }}</h2>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                                <i class="bi bi-calendar-check fs-3 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card stats-card border-0 shadow-sm bg-gradient-info">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="text-white-50 small">This Month</span>
                            <h2 class="mb-0 text-white">{{ $eventsThisMonth }}</h2>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                                <i class="bi bi-calendar-month fs-3 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card stats-card border-0 shadow-sm bg-gradient-success">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <span class="text-white-50 small">Upcoming Events</span>
                            <h2 class="mb-0 text-white">{{ $upcomingEvents }}</h2>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                                <i class="bi bi-calendar2-event fs-3 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Event List -->
        <div class="col-lg-5 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="bi bi-list-ul me-2 text-primary"></i>Upcoming Events
                    </h5>
                    <span class="badge bg-primary rounded-pill">{{ $events->count() }}</span>
                </div>
                <div class="card-body p-0">
                    @if($events->count() > 0)
                    <div class="list-group list-group-flush event-list">
                        @foreach($events as $event)
                            <div class="list-group-item border-0 px-4 py-3 event-item">
                                <div class="d-flex w-100 justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0 fw-bold text-dark event-title">{{ $event->title }}</h6>
                                    <span class="badge bg-light text-primary rounded-pill event-date">
                                        {{ \Carbon\Carbon::parse($event->start)->format('M d') }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between align-items-end">
                                    <small class="text-muted event-time">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ \Carbon\Carbon::parse($event->start)->format('h:i A') }} - 
                                        {{ \Carbon\Carbon::parse($event->end)->format('h:i A') }}
                                    </small>
                                    <div class="event-actions">
                                        @auth
                                            @if(Auth::user()->role === 'admin')
                                                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-outline-primary rounded-circle me-1">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            @endif
                                        @endauth
                                        <button class="btn btn-sm btn-outline-info rounded-circle view-event" data-event-id="{{ $event->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-calendar-x display-4 text-muted mb-3"></i>
                            <p class="text-muted">No upcoming events available.</p>
                            @auth
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.events.create') }}" class="btn btn-primary mt-2">
                                        <i class="bi bi-plus-circle me-1"></i> Create Your First Event
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Calendar -->
        <div class="col-lg-7">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="bi bi-calendar-date me-2 text-primary"></i>Calendar View
                    </h5>
                </div>
                <div class="card-body p-3">
                    <div id="calendar" class="fc-calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Event Details Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="fw-semibold text-dark mb-2">Title:</label>
                    <p id="eventTitle" class="mb-0 p-3 bg-light rounded"></p>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="fw-semibold text-dark mb-2">Start:</label>
                        <p id="eventStart" class="mb-0 p-3 bg-light rounded"></p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-semibold text-dark mb-2">End:</label>
                        <p id="eventEnd" class="mb-0 p-3 bg-light rounded"></p>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="fw-semibold text-dark mb-2">Description:</label>
                    <p id="eventDescription" class="mb-0 p-3 bg-light rounded"></p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: '{{ route("events.fetch") }}',
        eventClick: function(info) {
            document.getElementById('eventTitle').textContent = info.event.title;
            document.getElementById('eventStart').textContent = info.event.start.toLocaleString();
            document.getElementById('eventEnd').textContent = info.event.end ? info.event.end.toLocaleString() : 'N/A';
            document.getElementById('eventDescription').textContent = info.event.extendedProps.description || 'No description available';
            
            var modal = new bootstrap.Modal(document.getElementById('eventModal'));
            modal.show();
        },
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        },
        eventDisplay: 'block',
        eventColor: '#0d6efd',
        eventTextColor: '#fff',
        themeSystem: 'bootstrap5',
        dayMaxEventRows: 3,
        height: 'auto'
    });

    calendar.render();

    // Add event listeners for view buttons
    document.querySelectorAll('.view-event').forEach(button => {
        button.addEventListener('click', function() {
            const eventId = this.getAttribute('data-event-id');
            // In a real application, you would fetch event details via AJAX
            // For now, we'll just show the first event in the modal as an example
            document.getElementById('eventTitle').textContent = "Event " + eventId;
            document.getElementById('eventStart').textContent = new Date().toLocaleString();
            document.getElementById('eventEnd').textContent = new Date(Date.now() + 2*60*60*1000).toLocaleString();
            document.getElementById('eventDescription').textContent = "Description for event " + eventId;
            
            var modal = new bootstrap.Modal(document.getElementById('eventModal'));
            modal.show();
        });
    });
});
</script>

@section('styles')
<link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
@endsection

@endsection