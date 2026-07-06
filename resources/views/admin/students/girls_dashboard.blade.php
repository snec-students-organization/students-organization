@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">👩‍🎓 Girls Colleges Dashboard</h2>
            <p class="text-muted">Manage and view students from She and She Plus stream colleges</p>
        </div>
    </div>

    {{-- 🔍 Search Bar --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body bg-white rounded-3 p-3">
            <form method="GET" action="{{ route('admin.girls.dashboard') }}" class="row g-3 align-items-center">
                <div class="col-md-9">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0"
                               placeholder="Search by college name..."
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100 fw-semibold">
                         Apply Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.girls.dashboard') }}" class="btn btn-outline-secondary w-50">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- ✅ Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Left: Colleges Listing --}}
        <div class="col-lg-8">
            {{-- 🗂️ Tabs for Stream Separation --}}
            <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-white border rounded-5 shadow-sm mb-4" id="girlsDashboardTabs" role="tablist" style="max-width: 400px; margin: 0;">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-5 fw-semibold py-2" id="she-tab" data-bs-toggle="tab" data-bs-target="#she" type="button" role="tab" aria-controls="she" aria-selected="true">
                        🧕 She ({{ $sheInstitutions->count() }})
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-5 fw-semibold py-2" id="she-plus-tab" data-bs-toggle="tab" data-bs-target="#she-plus" type="button" role="tab" aria-controls="she-plus" aria-selected="false">
                        🎓 She Plus ({{ $shePlusInstitutions->count() }})
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="girlsDashboardTabsContent">
                {{-- She Tab Content --}}
                <div class="tab-pane fade show active" id="she" role="tabpanel" aria-labelledby="she-tab">
                    <h4 class="mb-3 text-dark fw-bold">🧕 She Stream Colleges</h4>
                    @forelse($sheInstitutions as $institution)
                        @include('admin.students.partials.institution_card', ['institution' => $institution])
                    @empty
                        <div class="card p-5 text-center shadow-sm border-0">
                            <p class="text-muted mb-0">No She colleges found.</p>
                        </div>
                    @endforelse
                </div>

                {{-- She Plus Tab Content --}}
                <div class="tab-pane fade" id="she-plus" role="tabpanel" aria-labelledby="she-plus-tab">
                    <h4 class="mb-3 text-dark fw-bold">🎓 She Plus Stream Colleges</h4>
                    @forelse($shePlusInstitutions as $institution)
                        @include('admin.students.partials.institution_card', ['institution' => $institution])
                    @empty
                        <div class="card p-5 text-center shadow-sm border-0">
                            <p class="text-muted mb-0">No She Plus colleges found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Right: Weekly Talents Meet Notifications --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white py-3 rounded-top-3">
                    <h5 class="card-title mb-0"><i class="bi bi-bell-fill me-2"></i> Talents Meet Notification</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.talents-meet-notifications.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sender_role" value="girls_admin">

                        <div class="mb-3">
                            <label for="topic" class="form-label fw-semibold text-dark">Topic</label>
                            <input type="text" class="form-control border-secondary-subtle" id="topic" name="topic" placeholder="Enter notification topic..." required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold text-dark">Description</label>
                            <textarea class="form-control border-secondary-subtle" id="description" name="description" rows="4" placeholder="Enter description..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold">
                            <i class="bi bi-send me-1"></i> Send Notification
                        </button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-light py-3 border-bottom rounded-top-3">
                    <h5 class="card-title mb-0 text-dark"><i class="bi bi-list-ul me-2"></i> Sent Notifications</h5>
                </div>
                <div class="card-body p-0" style="max-height: 400px; overflow-y: auto;">
                    @if($notifications->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($notifications as $notification)
                                <div class="list-group-item p-3 border-bottom-0 border-top">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="pe-2">
                                            <h6 class="fw-bold mb-1 text-dark">{{ $notification->topic }}</h6>
                                            <p class="text-muted small mb-2" style="white-space: pre-line;">{{ $notification->description }}</p>
                                            <span class="text-muted d-block" style="font-size: 0.75rem;">
                                                <i class="bi bi-clock me-1"></i> {{ $notification->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <form action="{{ route('admin.talents-meet-notifications.destroy', $notification->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this notification?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0 p-1" title="Delete Notification">
                                                <i class="bi bi-trash fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-bell-slash text-muted opacity-50" style="font-size: 2rem;"></i>
                            <p class="text-muted mb-0 small mt-2">No notifications sent yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
