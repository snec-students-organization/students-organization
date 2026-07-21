@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-4">

    {{-- ===== HEADER ===== --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 fw-bold">👩‍🎓 Girls Colleges Dashboard</h2>
            <p class="text-muted mb-0">She &amp; She Plus stream management</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.students.exportAll') }}" class="btn btn-outline-success btn-sm">
                <i class="bi bi-download me-1"></i> Export All
            </a>
        </div>
    </div>

    {{-- ===== STAT CARDS ===== --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #d63384 !important;">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#fce4ec;">
                            <i class="bi bi-building fs-5" style="color:#d63384;"></i>
                        </div>
                        <div>
                            <div class="fw-bold fs-4 lh-1" style="color:#d63384;">{{ $stats['total_colleges'] }}</div>
                            <div class="text-muted small">Colleges</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #6f42c1 !important;">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#f0ebff;">
                            <i class="bi bi-people-fill fs-5" style="color:#6f42c1;"></i>
                        </div>
                        <div>
                            <div class="fw-bold fs-4 lh-1" style="color:#6f42c1;">{{ $stats['total_students'] }}</div>
                            <div class="text-muted small">Students</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #198754 !important;">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#e8f5e9;">
                            <i class="bi bi-patch-check-fill text-success fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-bold fs-4 lh-1 text-success">{{ $stats['verified_students'] }}</div>
                            <div class="text-muted small">Verified</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #fd7e14 !important;">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#fff3e0;">
                            <i class="bi bi-hourglass-split text-warning fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-bold fs-4 lh-1 text-warning">{{ $stats['total_students'] - $stats['verified_students'] }}</div>
                            <div class="text-muted small">Pending</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #0dcaf0 !important;">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#e0f7fa;">
                            <i class="bi bi-shield-check text-info fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-bold fs-4 lh-1 text-info">{{ $stats['orgs_submitted'] }}</div>
                            <div class="text-muted small">Org Details</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #6c757d !important;">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;background:#f0f0f0;">
                            <i class="bi bi-collection-fill text-secondary fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-bold fs-4 lh-1 text-secondary">{{ $stats['data_submitted'] }}</div>
                            <div class="text-muted small">Data Saved</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== SUCCESS MESSAGE ===== --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ===== MAIN TABS: Students | Organization Data | Notifications ===== --}}
    <ul class="nav nav-tabs border-bottom mb-0" id="girlsMainTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active fw-semibold" id="girls-students-tab"
                    data-bs-toggle="tab" data-bs-target="#girls-students-panel"
                    type="button" role="tab">
                <i class="bi bi-people-fill me-1"></i> Students
                <span class="badge ms-1" style="background:#d63384;">{{ $stats['total_students'] }}</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold" id="girls-orgs-tab"
                    data-bs-toggle="tab" data-bs-target="#girls-orgs-panel"
                    type="button" role="tab">
                <i class="bi bi-building me-1"></i> Organization Data
                <span class="badge bg-info text-dark ms-1">{{ $stats['total_colleges'] }}</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link fw-semibold" id="girls-notifs-tab"
                    data-bs-toggle="tab" data-bs-target="#girls-notifs-panel"
                    type="button" role="tab">
                <i class="bi bi-bell-fill me-1"></i> Notifications
                <span class="badge bg-secondary ms-1">{{ $notifications->count() }}</span>
            </button>
        </li>
    </ul>

    <div class="tab-content bg-white border border-top-0 rounded-bottom-3 shadow-sm p-4" id="girlsMainTabsContent">

        {{-- ============================
             TAB 1 — STUDENTS
        ============================= --}}
        <div class="tab-pane fade show active" id="girls-students-panel" role="tabpanel">

            {{-- Search --}}
            <div class="mb-4">
                <form method="GET" action="{{ route('girls.dashboard') }}" class="row g-3 align-items-center">
                    <div class="col-md-9">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control border-start-0"
                                   placeholder="Search by college name..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn w-100 fw-semibold text-white" style="background:#d63384;">Apply Search</button>
                        @if(request('search'))
                            <a href="{{ route('girls.dashboard') }}" class="btn btn-outline-secondary">Reset</a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Stream Sub-Tabs --}}
            <ul class="nav nav-pills gap-2 p-1 small bg-light border rounded-5 shadow-sm mb-4 d-inline-flex" id="girlsStreamTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-5 fw-semibold py-2 px-3" id="she-tab"
                            data-bs-toggle="tab" data-bs-target="#she" type="button" role="tab">
                        🧕 She ({{ $sheInstitutions->count() }})
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-5 fw-semibold py-2 px-3" id="she-plus-tab"
                            data-bs-toggle="tab" data-bs-target="#she-plus" type="button" role="tab">
                        🎓 She Plus ({{ $shePlusInstitutions->count() }})
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="girlsStreamTabsContent">
                {{-- She --}}
                <div class="tab-pane fade show active" id="she" role="tabpanel">
                    <h5 class="mb-3 text-dark fw-bold">🧕 She Stream Colleges</h5>
                    @forelse($sheInstitutions as $institution)
                        @include('admin.students.partials.students_only_card', ['institution' => $institution])
                    @empty
                        <div class="card p-5 text-center shadow-sm border-0">
                            <p class="text-muted mb-0">No She colleges found.</p>
                        </div>
                    @endforelse
                </div>
                {{-- She Plus --}}
                <div class="tab-pane fade" id="she-plus" role="tabpanel">
                    <h5 class="mb-3 text-dark fw-bold">🎓 She Plus Stream Colleges</h5>
                    @forelse($shePlusInstitutions as $institution)
                        @include('admin.students.partials.students_only_card', ['institution' => $institution])
                    @empty
                        <div class="card p-5 text-center shadow-sm border-0">
                            <p class="text-muted mb-0">No She Plus colleges found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- ============================
             TAB 2 — ORGANIZATION DATA
        ============================= --}}
        <div class="tab-pane fade" id="girls-orgs-panel" role="tabpanel">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">🏢 Organization Data — All Girls Colleges</h5>
                <div class="d-flex gap-2">
                    <span class="badge bg-success">{{ $stats['orgs_submitted'] }} Org Submitted</span>
                    <span class="badge bg-info text-dark">{{ $stats['data_submitted'] }} Data Submitted</span>
                </div>
            </div>

            @forelse($allInstitutions as $institution)
                @php
                    $org = $institution->organization;
                    $instData = $institution->institutionData;
                @endphp
                <div class="card mb-3 border-0 shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center py-2"
                         style="background: linear-gradient(90deg,#d63384 0%,#9c27b0 100%);">
                        <div class="text-white">
                            <span class="fw-bold">{{ $institution->name }}</span>
                            <span class="badge bg-white ms-2 small" style="color:#d63384;">{{ ucfirst($institution->stream) }}</span>
                        </div>
                        <div class="d-flex gap-1">
                            @if($org)
                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Org Saved</span>
                            @else
                                <span class="badge bg-secondary">No Org</span>
                            @endif
                            @if($instData)
                                <span class="badge bg-info text-dark"><i class="bi bi-check-circle me-1"></i>Data Saved</span>
                            @else
                                <span class="badge bg-secondary">No Data</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body p-3">
                        @if(!$org && !$instData)
                            <p class="text-muted text-center py-2 mb-0 small">
                                <i class="bi bi-exclamation-circle me-1"></i>
                                No organization details or data collection info submitted yet.
                            </p>
                        @else
                            <div class="row g-3">
                                @if($org)
                                    <div class="col-lg-6">
                                        <div class="bg-light rounded-3 p-3 h-100">
                                            <h6 class="fw-bold mb-3" style="color:#d63384;">
                                                <i class="bi bi-shield-check me-1"></i> Students' Organization
                                            </h6>
                                            <div class="row g-2 small">
                                                <div class="col-sm-6">
                                                    <span class="text-muted d-block" style="font-size:0.72rem;">Organization Name</span>
                                                    <span class="fw-semibold">{{ $org->organization_name }}</span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="text-muted d-block" style="font-size:0.72rem;">Affiliation No</span>
                                                    <span class="fw-semibold" style="color:#d63384;">{{ $org->affiliation_number }}</span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="text-muted d-block" style="font-size:0.72rem;">Contact</span>
                                                    <span class="fw-semibold">{{ $org->contact_number }}</span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="text-muted d-block" style="font-size:0.72rem;">Email</span>
                                                    <span class="fw-semibold">{{ $org->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if($instData)
                                    <div class="col-lg-6">
                                        <div class="bg-light rounded-3 p-3 h-100">
                                            <h6 class="fw-bold text-info mb-3">
                                                <i class="bi bi-collection me-1"></i> Data Collection Details
                                            </h6>
                                            <div class="row g-2 small">
                                                <div class="col-12">
                                                    <span class="text-muted d-block" style="font-size:0.72rem;">Organization Full Name</span>
                                                    <span class="fw-semibold">{{ $instData->college_organization_full_name }} ({{ $instData->college_organization_short_name }})</span>
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="text-muted d-block" style="font-size:0.72rem;">Chairman</span>
                                                    <span class="fw-semibold d-block">{{ $instData->chairman_name }}</span>
                                                    <span class="text-muted" style="font-size:0.7rem;">{{ $instData->chairman_contact }}</span>
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="text-muted d-block" style="font-size:0.72rem;">Convener</span>
                                                    <span class="fw-semibold d-block">{{ $instData->convener_name }}</span>
                                                    <span class="text-muted" style="font-size:0.7rem;">{{ $instData->convener_contact }}</span>
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="text-muted d-block" style="font-size:0.72rem;">Treasurer</span>
                                                    <span class="fw-semibold d-block">{{ $instData->treasurer_name }}</span>
                                                    <span class="text-muted" style="font-size:0.7rem;">{{ $instData->treasurer_contact }}</span>
                                                </div>
                                                @if($instData->organization_director_name)
                                                    <div class="col-12">
                                                        <span class="text-muted d-block" style="font-size:0.72rem;">Director</span>
                                                        <span class="fw-semibold">{{ $instData->organization_director_name }}</span>
                                                        <span class="text-muted ms-2" style="font-size:0.7rem;">{{ $instData->organization_director_contact }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="bi bi-building-slash text-muted opacity-50" style="font-size:3rem;"></i>
                    <p class="text-muted mt-2">No colleges found.</p>
                </div>
            @endforelse
        </div>

        {{-- ============================
             TAB 3 — NOTIFICATIONS
        ============================= --}}
        <div class="tab-pane fade" id="girls-notifs-panel" role="tabpanel">
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="card border-0 bg-light h-100">
                        <div class="card-header text-white rounded-top-3 py-3" style="background:#d63384;">
                            <h6 class="mb-0"><i class="bi bi-send-fill me-1"></i> Send Talents Meet Notification</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.talents-meet-notifications.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="sender_role" value="girls_admin">
                                <div class="mb-3">
                                    <label for="girls-topic" class="form-label fw-semibold">Topic</label>
                                    <input type="text" class="form-control" id="girls-topic" name="topic"
                                           placeholder="Enter notification topic..." required>
                                </div>
                                <div class="mb-3">
                                    <label for="girls-description" class="form-label fw-semibold">Description</label>
                                    <textarea class="form-control" id="girls-description" name="description"
                                              rows="5" placeholder="Enter description..." required></textarea>
                                </div>
                                <button type="submit" class="btn w-100 fw-bold text-white" style="background:#d63384;">
                                    <i class="bi bi-send me-1"></i> Send Notification
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <h6 class="fw-bold mb-3"><i class="bi bi-list-ul me-1"></i> Sent Notifications</h6>
                    <div style="max-height:500px; overflow-y:auto;">
                        @forelse($notifications as $notification)
                            <div class="card mb-2 border-0 shadow-sm">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="pe-2 flex-grow-1">
                                            <h6 class="fw-bold mb-1">{{ $notification->topic }}</h6>
                                            <p class="text-muted small mb-1" style="white-space:pre-line;">{{ $notification->description }}</p>
                                            <span class="text-muted" style="font-size:0.72rem;">
                                                <i class="bi bi-clock me-1"></i> {{ $notification->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <form action="{{ route('admin.talents-meet-notifications.destroy', $notification->id) }}"
                                              method="POST" onsubmit="return confirm('Delete this notification?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0 p-1">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="bi bi-bell-slash text-muted opacity-50" style="font-size:2.5rem;"></i>
                                <p class="text-muted mt-2">No notifications sent yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- /tab-content --}}
</div>
@endsection
