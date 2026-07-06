@extends('layouts.institution')

@section('title', $talentsMeet->title)
@section('page-title', 'Weekly Talents Meet Details')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('institution.talents-meet.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
        <div class="d-flex gap-2">
            <button onclick="window.print();" class="btn btn-success fw-semibold">
                <i class="bi bi-printer me-1"></i> Print Program List
            </button>
            <a href="{{ route('institution.talents-meet.edit', $talentsMeet->id) }}" class="btn btn-primary fw-semibold">
                <i class="bi bi-pencil me-1"></i> Edit
            </a>
        </div>
    </div>

    <div class="card shadow-lg border-0 overflow-hidden print-area">
        {{-- Header Decoration --}}
        <div class="bg-primary text-white text-center py-5 px-3 position-relative">
            <div class="position-absolute top-50 start-50 translate-middle opacity-10">
                <i class="bi bi-music-note-beamed" style="font-size: 15rem;"></i>
            </div>
            <h5 class="text-uppercase tracking-wider opacity-75 mb-2">{{ auth('institution')->user()->name }}</h5>
            <h1 class="fw-bold display-6 mb-2">{{ $talentsMeet->title }}</h1>
            <p class="mb-0 fs-5">
                <i class="bi bi-calendar-event me-2"></i> {{ \Carbon\Carbon::parse($talentsMeet->meet_date)->format('l, d F Y') }}
            </p>
        </div>

        <div class="card-body p-5">
            <h4 class="text-center text-primary fw-bold mb-5 letter-spacing-1 border-bottom pb-3">PROGRAM LIST & SCHEDULE</h4>

            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-8">
                    <div class="agenda-timeline">
                        
                        {{-- 1. Qiraath --}}
                        @if($talentsMeet->qiraath)
                            <div class="agenda-item d-flex mb-4">
                                <div class="agenda-time text-end pe-4 pt-1 text-muted" style="width: 150px;">
                                    <span class="badge bg-light text-primary border px-3 py-2 fw-semibold">Program 01</span>
                                </div>
                                <div class="agenda-details border-start ps-4 pb-3" style="border-left-width: 3px !important; border-left-color: var(--primary-color) !important;">
                                    <h5 class="fw-bold text-dark mb-1">Qiraath</h5>
                                    <p class="text-muted mb-0"><i class="bi bi-person me-1"></i> Recited by: <strong class="text-secondary">{{ $talentsMeet->qiraath }}</strong></p>
                                </div>
                            </div>
                        @endif

                        {{-- 2. Welcome Speech --}}
                        @if($talentsMeet->welcome_speech)
                            <div class="agenda-item d-flex mb-4">
                                <div class="agenda-time text-end pe-4 pt-1 text-muted" style="width: 150px;">
                                    <span class="badge bg-light text-primary border px-3 py-2 fw-semibold">Program 02</span>
                                </div>
                                <div class="agenda-details border-start ps-4 pb-3" style="border-left-width: 3px !important; border-left-color: var(--primary-color) !important;">
                                    <h5 class="fw-bold text-dark mb-1">Welcome Speech</h5>
                                    <p class="text-muted mb-0"><i class="bi bi-person me-1"></i> Delivered by: <strong class="text-secondary">{{ $talentsMeet->welcome_speech }}</strong></p>
                                </div>
                            </div>
                        @endif

                        {{-- 3. Presidential Address --}}
                        @if($talentsMeet->presidential_address)
                            <div class="agenda-item d-flex mb-4">
                                <div class="agenda-time text-end pe-4 pt-1 text-muted" style="width: 150px;">
                                    <span class="badge bg-light text-primary border px-3 py-2 fw-semibold">Program 03</span>
                                </div>
                                <div class="agenda-details border-start ps-4 pb-3" style="border-left-width: 3px !important; border-left-color: var(--primary-color) !important;">
                                    <h5 class="fw-bold text-dark mb-1">Presidential Address</h5>
                                    <p class="text-muted mb-0"><i class="bi bi-person me-1"></i> Address by: <strong class="text-secondary">{{ $talentsMeet->presidential_address }}</strong></p>
                                </div>
                            </div>
                        @endif

                        {{-- 4. Inauguration Talk --}}
                        @if($talentsMeet->inauguration_talk)
                            <div class="agenda-item d-flex mb-4">
                                <div class="agenda-time text-end pe-4 pt-1 text-muted" style="width: 150px;">
                                    <span class="badge bg-light text-primary border px-3 py-2 fw-semibold">Program 04</span>
                                </div>
                                <div class="agenda-details border-start ps-4 pb-3" style="border-left-width: 3px !important; border-left-color: var(--primary-color) !important;">
                                    <h5 class="fw-bold text-dark mb-1">Inauguration Talk</h5>
                                    <p class="text-muted mb-0"><i class="bi bi-person me-1"></i> Inaugurated by: <strong class="text-secondary">{{ $talentsMeet->inauguration_talk }}</strong></p>
                                </div>
                            </div>
                        @endif

                        {{-- 5. Speeches --}}
                        @if($talentsMeet->speeches)
                            <div class="agenda-item d-flex mb-4">
                                <div class="agenda-time text-end pe-4 pt-1 text-muted" style="width: 150px;">
                                    <span class="badge bg-light text-primary border px-3 py-2 fw-semibold">Program 05</span>
                                </div>
                                <div class="agenda-details border-start ps-4 pb-3" style="border-left-width: 3px !important; border-left-color: var(--primary-color) !important;">
                                    <h5 class="fw-bold text-dark mb-2">Speeches</h5>
                                    <div class="text-secondary whitespace-pre-wrap">{!! nl2br(e($talentsMeet->speeches)) !!}</div>
                                </div>
                            </div>
                        @endif

                        {{-- 6. Songs --}}
                        @if($talentsMeet->songs)
                            <div class="agenda-item d-flex mb-4">
                                <div class="agenda-time text-end pe-4 pt-1 text-muted" style="width: 150px;">
                                    <span class="badge bg-light text-primary border px-3 py-2 fw-semibold">Program 06</span>
                                </div>
                                <div class="agenda-details border-start ps-4 pb-3" style="border-left-width: 3px !important; border-left-color: var(--primary-color) !important;">
                                    <h5 class="fw-bold text-dark mb-2">Songs & Performances</h5>
                                    <div class="text-secondary whitespace-pre-wrap">{!! nl2br(e($talentsMeet->songs)) !!}</div>
                                </div>
                            </div>
                        @endif

                        {{-- 7. Vote of Thanks --}}
                        @if($talentsMeet->vote_of_thanks)
                            <div class="agenda-item d-flex mb-4">
                                <div class="agenda-time text-end pe-4 pt-1 text-muted" style="width: 150px;">
                                    <span class="badge bg-light text-primary border px-3 py-2 fw-semibold">Program 07</span>
                                </div>
                                <div class="agenda-details border-start ps-4 pb-3" style="border-left-width: 3px !important; border-left-color: var(--primary-color) !important;">
                                    <h5 class="fw-bold text-dark mb-1">Vote of Thanks</h5>
                                    <p class="text-muted mb-0"><i class="bi bi-person me-1"></i> Proposed by: <strong class="text-secondary">{{ $talentsMeet->vote_of_thanks }}</strong></p>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-light text-center py-4 border-top">
            <p class="text-muted small mb-0">Powered by SNEC Students' Organization (SSO)</p>
        </div>
    </div>
</div>

<style>
    .tracking-wider {
        letter-spacing: 0.15em;
    }
    .letter-spacing-1 {
        letter-spacing: 0.05em;
    }
    .whitespace-pre-wrap {
        white-space: pre-wrap;
    }
    .agenda-details {
        flex-grow: 1;
    }
    
    @media print {
        body * {
            visibility: hidden;
        }
        .print-area, .print-area * {
            visibility: visible;
        }
        .print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .btn, nav, footer, .mb-4 {
            display: none !important;
        }
    }
</style>
@endsection
