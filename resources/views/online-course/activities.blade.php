@extends('layouts.app')

@push('styles')
    <style>
        :root {
            --dark-bg: #0f172a;
            --dark-card: #1e293b;
            --dark-border: #334155;
            --dark-text: #f8fafc;
            --dark-text-muted: #94a3b8;
            --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        body {
            background-color: var(--dark-bg) !important;
            color: var(--dark-text) !important;
        }

        .page-header {
            border-bottom: 1px solid var(--dark-border);
            margin-bottom: 2rem;
            padding-bottom: 1rem;
        }

        .page-title {
            color: var(--dark-text);
            font-weight: 700;
        }

        .activity-card {
            background-color: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 1rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            overflow: hidden;
        }

        .activity-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.3);
            border-color: #10b981;
        }

        .activity-icon {
            color: #10b981;
            font-size: 2rem;
        }

        .activity-title {
            color: var(--dark-text);
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .activity-date {
            color: var(--dark-text-muted);
            font-size: 0.85rem;
        }

        .activity-desc {
            color: #cbd5e1;
        }

        .btn-open {
            background: var(--success-gradient);
            color: white;
            border: none;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: opacity 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-open:hover {
            opacity: 0.9;
            color: white;
        }

        .btn-back {
            color: var(--dark-text-muted);
            border: 1px solid var(--dark-border);
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-back:hover {
            background-color: var(--dark-border);
            color: white;
        }
    </style>
@endpush

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center mb-4">
            <div class="col-md-10">
                <div class="d-flex justify-content-between align-items-center page-header">
                    <div>
                        <h2 class="page-title mb-1">Activities & Assignments</h2>
                        <p class="text-muted mb-0">Complete your pending tasks.</p>
                    </div>
                    <a href="{{ route('online-course.index') }}" class="btn btn-back">
                        <i class="bi bi-arrow-left me-2"></i> back
                    </a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                @if($activities->isEmpty())
                    <div class="alert alert-dark border-secondary text-center py-5">
                        <i class="bi bi-journal-x display-4 text-muted mb-3"></i>
                        <h5 class="text-white">No active activities</h5>
                        <p class="text-muted">Check back later for new assignments.</p>
                    </div>
                @else
                    <div class="d-flex flex-column gap-3">
                        @foreach($activities as $activity)
                            <div class="activity-card p-4">
                                <div class="d-flex align-items-start">
                                    <div class="me-4 d-none d-sm-block">
                                        <div class="activity-icon">
                                            <i class="bi bi-journal-code"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start flex-wrap">
                                            <div>
                                                <h5 class="activity-title">{{ $activity->title }}</h5>
                                                <span class="activity-date">
                                                    <i class="bi bi-clock me-1"></i> Posted
                                                    {{ $activity->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            @if($activity->link)
                                                <a href="{{ $activity->link }}" target="_blank" class="btn-open mt-2 mt-sm-0">
                                                    Open Resource <i class="bi bi-box-arrow-up-right ms-1"></i>
                                                </a>
                                            @endif
                                        </div>
                                        <hr class="border-secondary my-3">
                                        <p class="activity-desc mb-0">{{ $activity->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection