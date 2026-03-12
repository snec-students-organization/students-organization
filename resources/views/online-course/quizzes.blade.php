@extends('layouts.app')

@push('styles')
    <style>
        :root {
            --dark-bg: #0f172a;
            --dark-card: #1e293b;
            --dark-border: #334155;
            --dark-text: #f8fafc;
            --dark-text-muted: #94a3b8;
            --danger-gradient: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
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

        .quiz-card {
            background-color: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 1rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .quiz-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.3);
            border-color: #ef4444;
        }

        .quiz-icon {
            color: #ef4444;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .quiz-title {
            color: var(--dark-text);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .quiz-date {
            color: var(--dark-text-muted);
            font-size: 0.85rem;
            margin-bottom: 1rem;
            display: block;
        }

        .quiz-desc {
            color: #cbd5e1;
            flex-grow: 1;
            margin-bottom: 1.5rem;
        }

        .btn-start {
            background: var(--danger-gradient);
            color: white;
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.9rem;
            width: 100%;
            transition: opacity 0.2s;
            text-decoration: none;
            text-align: center;
            display: block;
        }

        .btn-start:hover {
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
                        <h2 class="page-title mb-1">Available Quizzes</h2>
                        <p class="text-muted mb-0">Test your knowledge.</p>
                    </div>
                    <a href="{{ route('online-course.index') }}" class="btn btn-back">
                        <i class="bi bi-arrow-left me-2"></i> back
                    </a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                @if($quizzes->isEmpty())
                    <div class="alert alert-dark border-secondary text-center py-5">
                        <i class="bi bi-question-circle display-4 text-muted mb-3"></i>
                        <h5 class="text-white">No quizzes available</h5>
                        <p class="text-muted">Great job! You're all caught up.</p>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($quizzes as $quiz)
                            <div class="col-md-6">
                                <div class="quiz-card p-4">
                                    <div class="text-center">
                                        <div class="quiz-icon">
                                            <i class="bi bi-lightning-charge"></i>
                                        </div>
                                        <h5 class="quiz-title">{{ $quiz->title }}</h5>
                                        <span class="quiz-date">
                                            Added {{ $quiz->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                    <p class="quiz-desc text-center">
                                        {{ \Illuminate\Support\Str::limit($quiz->description, 100) }}
                                    </p>
                                    <div>
                                        @if($quiz->link)
                                            <a href="{{ $quiz->link }}" target="_blank" class="btn-start">
                                                Take Quiz <i class="bi bi-arrow-right-short"></i>
                                            </a>
                                        @else
                                            <button class="btn btn-secondary w-100" disabled>No Link Available</button>
                                        @endif
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