@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">👨‍🎓 Boys Colleges Dashboard</h2>
            <p class="text-muted">Manage and view students from Sharia, Sharia Plus, and Bayyinath stream colleges</p>
        </div>
    </div>

    {{-- 🔍 Search Bar --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body bg-white rounded-3 p-3">
            <form method="GET" action="{{ route('admin.boys.dashboard') }}" class="row g-3 align-items-center">
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
                        <a href="{{ route('admin.boys.dashboard') }}" class="btn btn-outline-secondary w-50">
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
            <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-white border rounded-5 shadow-sm mb-4" id="boysDashboardTabs" role="tablist" style="max-width: 600px; margin: 0;">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-5 fw-semibold py-2" id="sharia-tab" data-bs-toggle="tab" data-bs-target="#sharia" type="button" role="tab" aria-controls="sharia" aria-selected="true">
                        🕌 Sharia ({{ $shariaInstitutions->count() }})
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-5 fw-semibold py-2" id="sharia-plus-tab" data-bs-toggle="tab" data-bs-target="#sharia-plus" type="button" role="tab" aria-controls="sharia-plus" aria-selected="false">
                        📚 Sharia Plus ({{ $shariaPlusInstitutions->count() }})
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-5 fw-semibold py-2" id="bayyinath-tab" data-bs-toggle="tab" data-bs-target="#bayyinath" type="button" role="tab" aria-controls="bayyinath" aria-selected="false">
                        🌟 Bayyinath ({{ $bayyinathInstitutions->count() }})
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="boysDashboardTabsContent">
                {{-- Sharia Tab Content --}}
                <div class="tab-pane fade show active" id="sharia" role="tabpanel" aria-labelledby="sharia-tab">
                    <h4 class="mb-3 text-dark fw-bold">🕌 Sharia Stream Colleges</h4>
                    @forelse($shariaInstitutions as $institution)
                        @include('admin.students.partials.institution_card', ['institution' => $institution])
                    @empty
                        <div class="card p-5 text-center shadow-sm border-0">
                            <p class="text-muted mb-0">No Sharia colleges found.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Sharia Plus Tab Content --}}
                <div class="tab-pane fade" id="sharia-plus" role="tabpanel" aria-labelledby="sharia-plus-tab">
                    <h4 class="mb-3 text-dark fw-bold">📚 Sharia Plus Stream Colleges</h4>
                    @forelse($shariaPlusInstitutions as $institution)
                        @include('admin.students.partials.institution_card', ['institution' => $institution])
                    @empty
                        <div class="card p-5 text-center shadow-sm border-0">
                            <p class="text-muted mb-0">No Sharia Plus colleges found.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Bayyinath Tab Content --}}
                <div class="tab-pane fade" id="bayyinath" role="tabpanel" aria-labelledby="bayyinath-tab">
                    <h4 class="mb-3 text-dark fw-bold">🌟 Bayyinath Stream Colleges</h4>
                    @forelse($bayyinathInstitutions as $institution)
                        @include('admin.students.partials.institution_card', ['institution' => $institution])
                    @empty
                        <div class="card p-5 text-center shadow-sm border-0">
                            <p class="text-muted mb-0">No Bayyinath colleges found.</p>
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
                        <input type="hidden" name="sender_role" value="boys_admin">

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
