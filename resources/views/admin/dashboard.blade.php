@extends('layouts.app')

@section('styles')
<style>
.dashboard-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 0.75rem;
}
.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
}
.stat-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.75rem;
    margin-bottom: 1rem;
}
.card-gradient-1 {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
}
.card-gradient-2 {
    background: linear-gradient(135deg, #198754 0%, #146c43 100%);
}
.card-gradient-3 {
    background: linear-gradient(135deg, #ffc107 0%, #ffcd39 100%);
}
.card-gradient-4 {
    background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);
}
.card-gradient-5 {
    background: linear-gradient(135deg, #6f42c1 0%, #593196 100%);
}
.card-gradient-6 {
    background: linear-gradient(135deg, #dc3545 0%, #a71d2a 100%);
}
.recent-activity {
    max-height: 400px;
    overflow-y: auto;
}
.activity-item {
    border-left: 3px solid #0d6efd;
    padding-left: 1rem;
    margin-bottom: 1.5rem;
}
.activity-item:last-child {
    margin-bottom: 0;
}
.quick-action-btn {
    transition: all 0.3s ease;
}
.quick-action-btn:hover {
    transform: translateY(-3px);
}
</style>
@endsection

@section('content')
<div class="container-fluid py-4">

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        {{-- Total Organizations --}}
        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card shadow-sm card-gradient-1 text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Total Organizations</h6>
                        <h3>{{ $orgCount }}</h3>
                    </div>
                    <div class="stat-icon bg-white text-primary">
                        <i class="bi bi-building fs-3"></i>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('organizations.index') }}" class="text-white small">
                        View all organizations <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Total Events --}}
        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card shadow-sm card-gradient-2 text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Total Events</h6>
                        <h3>{{ $eventCount }}</h3>
                    </div>
                    <div class="stat-icon bg-white text-success">
                        <i class="bi bi-calendar-event fs-3"></i>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('admin.events.index') }}" class="text-white small">
                        View all events <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Total Users --}}
        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card shadow-sm card-gradient-3 text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Total Users</h6>
                        <h3>{{ $userCount }}</h3>
                    </div>
                    <div class="stat-icon bg-white text-warning">
                        <i class="bi bi-people fs-3"></i>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('admin.users.index') }}" class="text-white small">
                        Manage users <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Feature Flag Edit --}}
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('admin.feature_flags.edit') }}" style="text-decoration:none;">
                <div class="card dashboard-card shadow-sm card-gradient-5 text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Edit Datacollection Section</h6>
                            <p class="mb-0">Turn it on/off</p>
                        </div>
                        <div class="stat-icon bg-white text-purple">
                            <i class="bi bi-toggle-on fs-3"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <span class="text-white small">
                            Edit  <i class="bi bi-arrow-right"></i>
                        </span>
                    </div>
                </div>
            </a>
        </div>

        {{-- Data Collection --}}
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('admin.data.collection.institutions') }}" style="text-decoration:none;">
                <div class="card dashboard-card shadow-sm card-gradient-6 text-white">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Data Collection</h6>
                            <p class="mb-0">Check Collected Data</p>
                        </div>
                        <div class="stat-icon bg-white text-danger">
                            <i class="bi bi-collection fs-3"></i>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <span class="text-white small">
                            View data <i class="bi bi-arrow-right"></i>
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Quick Actions, Upcoming Events, Recent Activity -->
    <div class="row g-4">
        <!-- Quick Actions -->
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="{{ $quickLinks['new_event'] }}" class="btn btn-outline-primary w-100 quick-action-btn py-3">
                                <i class="bi bi-plus-circle d-block fs-2 mb-2"></i>New Event
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ $quickLinks['add_organization'] }}" class="btn btn-outline-success w-100 quick-action-btn py-3">
                                <i class="bi bi-building-add d-block fs-2 mb-2"></i>Add Organization
                            </a>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="col-xl-4 col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Upcoming Events</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                    @forelse($upcomingEvents as $event)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $event->title }}</span>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($event->start)->format('M d, Y') }}</small>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">No upcoming events</li>
                    @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Activity</h5>
                </div>
                <div class="card-body recent-activity">
                    @forelse($activities as $activity)
                    <div class="activity-item">
                        <strong>{{ $activity->user->name }}</strong> {{ $activity->description }}<br />
                        <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                    </div>
                    @empty
                    <p class="text-muted">No recent activities.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
