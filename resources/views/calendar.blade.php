@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-0 text-primary"><i class="bi bi-calendar-event me-2"></i>Event Calendar</h2>
            <p class="text-muted mb-0">View and manage all upcoming events</p>
        </div>
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.events.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-1"></i> Add Event
                </a>
            @endif
        @endauth
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="card-title">Total Events</h5>
                            <h2 class="mb-0">{{ $events->count() }}</h2>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="bi bi-calendar-check display-6 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="card-title">This Month</h5>
                            <h2 class="mb-0">{{ $eventsThisMonth }}</h2>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="bi bi-calendar-month display-6 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="card-title">Upcoming</h5>
                            <h2 class="mb-0">{{ $upcomingEvents }}</h2>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="bi bi-calendar2-event display-6 opacity-50"></i>
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
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-secondary">
                        <i class="bi bi-list-ul me-2"></i>Upcoming Events
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($events as $event)
                            <div class="list-group-item border-0">
                                <div class="d-flex w-100 justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0 fw-bold text-dark">{{ $event->title }}</h6>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($event->start)->format('M d') }}</small>
                                </div>
                                <div class="d-flex justify-content-between align-items-end">
                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ \Carbon\Carbon::parse($event->start)->format('h:i A') }} - 
                                        {{ \Carbon\Carbon::parse($event->end)->format('h:i A') }}
                                    </small>
                                    <div>
                                        @auth
                                            @if(Auth::user()->role === 'admin')
                                                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            @endif
                                        @endauth
                                        <button class="btn btn-sm btn-outline-info view-event" data-event-id="{{ $event->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="bi bi-calendar-x display-4 text-muted"></i>
                                <p class="text-muted mt-3">No upcoming events available.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar -->
        <div class="col-lg-7">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-secondary">
                        <i class="bi bi-calendar-date me-2"></i>Calendar View
                    </h5>
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Event Details Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="fw-semibold">Title:</label>
                    <p id="eventTitle" class="mb-0 p-2 bg-light rounded"></p>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="fw-semibold">Start:</label>
                        <p id="eventStart" class="mb-0 p-2 bg-light rounded"></p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-semibold">End:</label>
                        <p id="eventEnd" class="mb-0 p-2 bg-light rounded"></p>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="fw-semibold">Description:</label>
                    <p id="eventDescription" class="mb-0 p-2 bg-light rounded"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        eventTextColor: '#fff'
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

<style>
.fc {
    font-family: inherit;
}
.fc-toolbar-title {
    font-size: 1.25rem;
    font-weight: 600;
}
.fc-event {
    cursor: pointer;
    border: none;
    padding: 2px 4px;
}
.fc-daygrid-event-dot {
    display: none;
}
.fc-daygrid-dot-event .fc-event-title {
    font-weight: 500;
}
.stats-card {
    transition: transform 0.2s;
}
.stats-card:hover {
    transform: translateY(-5px);
}
</style>
@endsection