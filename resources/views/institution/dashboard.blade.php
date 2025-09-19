@extends('layouts.institution')

@section('content')
<div class="container py-4">

    {{-- Welcome Header --}}
    <div class="welcome-header bg-gradient-primary rounded-3 p-4 mb-4 text-white shadow">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-bold mb-1">👋 Welcome, {{ auth('institution')->user()->name }}</h1>
                <p class="mb-0 opacity-75">Here's what's happening with your institution today</p>
            </div>
            <div class="d-none d-md-block">
                <div class="bg-white bg-opacity-25 rounded-pill px-3 py-1">
                    <small class="fw-medium">{{ now()->format('l, F j, Y') }}</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash Messages --}}
    @foreach (['success' => 'success', 'error' => 'danger'] as $msg => $type)
        @if(session($msg))
            <div class="alert alert-{{ $type }} alert-dismissible fade show shadow-sm mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-{{ $type == 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill' }} me-2"></i>
                    <div>{{ session($msg) }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    @endforeach

    {{-- Selected Institution Data --}}
    @if(isset($selectedData))
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white py-2">
            <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i> Submitted Institution Data</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label text-muted small mb-1">College Name</label>
                    <p class="mb-0 fw-medium">{{ $selectedData->college_name }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small mb-1">Stream</label>
                    <p class="mb-0 fw-medium">{{ $selectedData->stream }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small mb-1">Affiliation Number</label>
                    <p class="mb-0 fw-medium">{{ $selectedData->affiliation_number }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small mb-1">Address</label>
                    <p class="mb-0 fw-medium">{{ $selectedData->full_address }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small mb-1">Organization Name</label>
                    <p class="mb-0 fw-medium">{{ $selectedData->college_organization_full_name }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small mb-1">Email</label>
                    <p class="mb-0 fw-medium">{{ $selectedData->email }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Stats Overview --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stats-card card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon bg-primary bg-opacity-10 text-primary rounded-3 p-3 me-3">
                            <i class="bi bi-people fs-2"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-0">{{ $students_count ?? 0 }}</h3>
                            <p class="text-muted mb-0">Total Students</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @if(isset($last_payment))
        <div class="col-md-4">
            <div class="stats-card card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon bg-success bg-opacity-10 text-success rounded-3 p-3 me-3">
                            <i class="bi bi-credit-card fs-2"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-0">₹{{ $last_payment->amount }}</h3>
                            <p class="text-muted mb-0">Last Payment</p>
                            <small class="text-muted">{{ optional($last_payment->created_at)->format('M j, Y') ?? '--' }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <div class="col-md-4">
            <div class="stats-card card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon bg-info bg-opacity-10 text-info rounded-3 p-3 me-3">
                            <i class="bi bi-building fs-2"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-0">{{ $institution->short_name ?? '--' }}</h3>
                            <p class="text-muted mb-0">Your Institution</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Left Column --}}
        <div class="col-lg-8">
            {{-- Recent Students --}}
            <div class="card shadow-sm">
                <div class="card-header bg-light py-3">
                    <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i> Recently Registered Students</h5>
                </div>
                <div class="card-body p-0">
                    @if(isset($recent_students) && count($recent_students) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Enrollment No</th>
                                        <th>Email</th>
                                        <th>Registered At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recent_students as $student)
                                        <tr>
                                            <td class="fw-medium">{{ $student->name }}</td>
                                            <td><span class="badge bg-light text-dark">{{ $student->uid ?? '--' }}</span></td>
                                            <td>{{ $student->email }}</td>
                                            <td><small class="text-muted">{{ $student->created_at?->format('d M Y') ?? '--' }}</small></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-people display-4 text-light"></i>
                            <p class="text-muted mt-3">No students registered yet.</p>
                            <a href="#" class="btn btn-primary mt-2">Add Students</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="col-lg-4">
           {{-- Organization Info --}}
@if(isset($organization))
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-diagram-3 me-2"></i> Organization Info</h5>
            <span class="badge 
                {{ $organization->status === 'verified' ? 'bg-success' : 'bg-warning text-dark' }}">
                {{ ucfirst($organization->status) }}
            </span>
        </div>

        <div class="card-body">
            <p class="fw-bold mb-2">{{ $organization->organization_name ?? '—' }}</p>

            {{-- ✅ Membership Card --}}
            @if($organization->status === 'verified' && isset($institution))
                <div class="membership-card border rounded-3 p-3 shadow-sm mt-3">
                    <h6 class="text-primary fw-bold mb-3">Membership Card</h6>
                    <p class="mb-1"><strong>Organization:</strong> {{ $institution->name }}</p>
                    <p class="mb-1"><strong>Membership No:</strong> 
                        <span class="badge bg-success">{{ $institution->membership_number }}</span>
                    </p>
                    <p class="mb-1"><strong>College:</strong> {{ $selectedData->college_name ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $selectedData->email ?? $institution->email }}</p>

                    <div class="mt-3">
                        <a href="{{ route('membership-card.download') }}" class="btn btn-outline-success btn-sm">
                            <i class="bi bi-download me-1"></i> Download PDF
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@else
    <div class="card shadow-sm mb-4">
        <div class="card-body text-center py-4">
            <i class="bi bi-building display-4 text-light mb-3"></i>
            <h5>No Organization Added</h5>
            <a href="{{ route('institution.organization.form') }}" class="btn btn-primary">Add Organization</a>
        </div>
    </div>
@endif



            {{-- Quick Actions --}}
            <div class="card shadow-sm">
                <div class="card-header bg-light py-3">
                    <h5 class="mb-0"><i class="bi bi-lightning me-2"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('institution.students.index') }}" class="btn btn-outline-primary text-start py-3">
                            <i class="bi bi-people me-2"></i> Manage Students
                        </a>
                        <a href="{{ route('payments.institution.create') }}" class="btn btn-outline-primary text-start py-3">
                            <i class="bi bi-credit-card me-2"></i> Working Fund
                        </a>
                        <a href="{{ route('institution.organization.form') }}" class="btn btn-outline-primary text-start py-3">
                            <i class="bi bi-building me-2"></i> Organization Details
                        </a>
                        <a href="{{ route('institution-data.create') }}" class="btn btn-outline-primary text-start py-3">
                            <i class="bi bi-plus-circle me-2"></i> Add Data
                        </a>
                       <a href="{{ route('institution.reports.upload') }}" class="btn btn-outline-primary text-start py-3">
    <i class="bi bi-plus-circle me-2"></i> Upload Monthly Report
</a>

<a href="{{ route('institution.reports.index') }}" class="btn btn-outline-primary text-start py-3">
    <i class="bi bi-folder2-open me-2"></i> View Uploaded Reports
</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<style>
    .welcome-header {
        background: linear-gradient(135deg, #0a58ca, #5c7cb4ff);
    }
    
    .stats-card {
        transition: transform 0.2s;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
    }
    
    .stats-icon {
        transition: all 0.3s ease;
    }
    
    .stats-card:hover .stats-icon {
        background-opacity: 1 !important;
    }
    
    .hover-shadow {
        transition: all 0.3s ease;
    }
    
    .hover-shadow:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        transform: translateY(-3px);
    }
</style>
@endsection
