@extends('layouts.app')

@push('styles')
<style>
    :root {
        --dark-bg: #0f172a;
        --dark-card: #1e293b;
        --dark-border: #334155;
        --dark-text: #f8fafc;
        --dark-text-muted: #94a3b8;
        --primary-gradient: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
        --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        --danger-gradient: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        --info-gradient: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
    }

    body {
        background-color: var(--dark-bg) !important;
        color: var(--dark-text) !important;
    }

    .page-header {
        position: relative;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--dark-border);
        margin-bottom: 3rem;
    }

    .page-title {
        font-weight: 800;
        letter-spacing: -0.025em;
        background: linear-gradient(to right, #60a5fa, #a78bfa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .stats-card {
        background-color: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 1rem;
        padding: 1.5rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
        border-color: #475569;
    }

    .stats-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: white;
    }

    .card-title {
        color: var(--dark-text);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .card-text {
        color: var(--dark-text-muted);
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
    }

    .btn-action {
        width: 100%;
        padding: 0.75rem;
        border-radius: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 0.85rem;
        border: none;
        transition: opacity 0.2s;
    }
    
    .btn-action:hover {
        opacity: 0.9;
        color: white;
    }

    .progress-dark {
        background-color: #334155;
        border-radius: 0.5rem;
        height: 10px;
        overflow: hidden;
    }

    .progress-bar-glow {
        box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
    }
    
    .bg-gradient-primary { background: var(--primary-gradient); }
    .bg-gradient-success { background: var(--success-gradient); }
    .bg-gradient-warning { background: var(--warning-gradient); }
    .bg-gradient-danger { background: var(--danger-gradient); }
    .bg-gradient-info { background: var(--info-gradient); }
</style>
@endpush

@section('content')
<div class="container py-5">
    {{-- Header --}}
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title display-5 mb-1">Online Course Portal</h1>
            <p class="text-secondary mb-0">Welcome back, {{ Auth::user()->name }}</p>
        </div>
        <div>
            <span class="badge bg-dark border border-secondary px-3 py-2 rounded-pill">
                <i class="bi bi-calendar-check me-2 text-info"></i>
                {{ now()->format('l, F j, Y') }}
            </span>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success bg-transparent border-success text-success mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger bg-transparent border-danger text-danger mb-4" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i> {{ session('error') }}
        </div>
    @endif

    @if(!$student)
        <div class="alert alert-warning bg-transparent border-warning text-warning text-center">
            <i class="bi bi-exclamation-triangle fa-2x mb-3"></i><br>
            Student record not found for your account. Please contact support.
        </div>
    @elseif(!$isRegistered)
        {{-- Registration Card --}}
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="stats-card text-center p-5">
                    <div class="mb-4 text-info">
                        <i class="bi bi-person-plus-fill display-1"></i>
                    </div>
                    <h2 class="fw-bold mb-3 text-white">Join the Online Course</h2>
                    <p class="text-muted mb-4 lead">Register now to access course materials, quizzes, and track your attendance.</p>

                    @if($registrationEnabled)
                        <form action="{{ route('online-course.register') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-action bg-gradient-primary text-white w-50 mx-auto">
                                Enroll Now
                            </button>
                        </form>
                    @else
                        <button class="btn btn-action bg-secondary text-white-50 w-50 mx-auto" disabled>
                            Registration Closed
                        </button>
                        <p class="mt-3 text-muted small">Registration is currently unavailable.</p>
                    @endif
                </div>
            </div>
        </div>
    @else
        {{-- Main Grid --}}
        <div class="row g-4">
            {{-- 1. Class Room Card --}}
            <div class="col-md-6 col-lg-4">
                <div class="stats-card">
                    <div class="stats-icon bg-gradient-primary">
                        <i class="bi bi-camera-video-fill"></i>
                    </div>
                    <h4 class="card-title">Live Class Room</h4>
                    <p class="card-text">Join the live session or view schedule.</p>
                    
                    @if(!empty($meetingLink))
                        <a href="{{ $meetingLink }}" target="_blank" class="btn btn-action bg-gradient-primary text-white">
                            <i class="bi bi-camera-video me-2"></i> Join Now
                        </a>
                    @else
                        <button class="btn btn-action bg-secondary text-white-50" disabled>
                            <i class="bi bi-slash-circle me-2"></i> No Class Scheduled
                        </button>
                    @endif
                </div>
            </div>

            {{-- 2. Activities Card --}}
            <div class="col-md-6 col-lg-4">
                <div class="stats-card">
                    <div class="stats-icon bg-gradient-success">
                        <i class="bi bi-journal-check"></i>
                    </div>
                    <h4 class="card-title">Course Activities</h4>
                    <p class="card-text">View assignments and learning tasks.</p>
                    <a href="{{ route('online-course.activities') }}" class="btn btn-action bg-gradient-success text-white">
                        <i class="bi bi-arrow-right-circle me-2"></i> View Activities
                    </a>
                </div>
            </div>

            {{-- 3. Quiz Card --}}
            <div class="col-md-6 col-lg-4">
                <div class="stats-card">
                    <div class="stats-icon bg-gradient-danger">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                    <h4 class="card-title">Quizzes</h4>
                    <p class="card-text">Test your knowledge with quick quizzes.</p>
                    <a href="{{ route('online-course.quizzes') }}" class="btn btn-action bg-gradient-danger text-white">
                        <i class="bi bi-play-circle me-2"></i> Start Quiz
                    </a>
                </div>
            </div>

            {{-- 4. Attendance Card --}}
            <div class="col-md-6 col-lg-6">
                <div class="stats-card">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stats-icon bg-gradient-warning mb-0 me-3" style="width: 40px; height: 40px; font-size: 1.2rem;">
                            <i class="bi bi-person-check-fill"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">Daily Attendance</h5>
                        </div>
                    </div>
                    
                    @if($attendanceMarkedToday)
                        <div class="text-center py-3">
                            <i class="bi bi-check-circle-fill text-success display-4 mb-2"></i>
                            <h5 class="text-success mb-0">Marked for Today</h5>
                            <p class="text-muted small">See you tomorrow!</p>
                        </div>
                    @elseif($attendanceEnabled)
                        <p class="card-text">Don't forget to mark your attendance daily.</p>
                        <form action="{{ route('online-course.attendance') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-action bg-gradient-warning text-white">
                                <i class="bi bi-fingerprint me-2"></i> Mark Present
                            </button>
                        </form>
                    @else
                        <div class="text-center py-3">
                            <i class="bi bi-slash-circle text-muted display-4 mb-2"></i>
                            <h5 class="text-muted mb-0">Attendance Closed</h5>
                        </div>
                    @endif
                </div>
            </div>

            {{-- 5. Progress Card --}}
            <div class="col-md-6 col-lg-6">
                <div class="stats-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex align-items-center">
                            <div class="stats-icon bg-gradient-info mb-0 me-3" style="width: 40px; height: 40px; font-size: 1.2rem;">
                                <i class="bi bi-graph-up-arrow"></i>
                            </div>
                            <h5 class="card-title mb-0">Your Progress</h5>
                        </div>
                        <span class="badge bg-secondary rounded-pill">{{ $attendanceCount }} Days Attended</span>
                    </div>
                    
                    <div class="py-2">
                        <div class="d-flex justify-content-between text-muted small mb-2">
                            <span>Attendance Goal (30 Days)</span>
                            <span class="text-info font-monospace">{{ $progressPercentage }}%</span>
                        </div>
                        <div class="progress progress-dark">
                            <div class="progress-bar bg-gradient-info progress-bar-glow" 
                                role="progressbar" 
                                style="width: {{ $progressPercentage }}%" 
                                aria-valuenow="{{ $progressPercentage }}" 
                                aria-valuemin="0" 
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                    <p class="text-muted small mt-3 mb-0">
                        <i class="bi bi-info-circle me-1"></i> Consistent attendance unlocks certificates.
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection