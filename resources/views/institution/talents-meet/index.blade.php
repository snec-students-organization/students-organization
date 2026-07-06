@extends('layouts.institution')

@section('title', 'Weekly Talents Meet Dashboard')
@section('page-title', 'Weekly Talents Meet')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Weekly Talents Meet</h2>
            <p class="text-muted">Create and manage weekly program lists for student talent showcases</p>
        </div>
        <a href="{{ route('institution.talents-meet.create') }}" class="btn btn-primary shadow-sm fw-semibold">
            <i class="bi bi-plus-lg me-1"></i> Create Program List
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- 📢 Talents Meet Announcements --}}
    @if(isset($notifications) && $notifications->count() > 0)
        <div class="card border-0 shadow mb-4 rounded-3" style="background: #ffffff; border: 1px solid #e2e8f0 !important;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: #f1f5f9;">
                        <i class="bi bi-megaphone-fill fs-4" style="color: #334155;"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0" style="color: #1e293b;">Important Announcements</h4>
                        <p class="mb-0 small" style="color: #64748b;">Latest updates from your admin</p>
                    </div>
                </div>
                
                <div class="accordion accordion-flush" id="announcementsAccordion">
                    @foreach($notifications as $index => $notification)
                        <div class="accordion-item border-0 {{ !$loop->last ? 'mb-2' : '' }}" style="background: transparent;">
                            <h2 class="accordion-header" id="heading-{{ $notification->id }}">
                                <button class="accordion-button collapsed fw-semibold px-3 py-2 rounded border-0" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#collapse-{{ $notification->id }}" 
                                        aria-expanded="false" 
                                        aria-controls="collapse-{{ $notification->id }}"
                                        style="box-shadow: none; background: #f1f5f9; color: #1e293b;">
                                    <span class="d-flex align-items-center w-100">
                                        <i class="bi bi-info-circle me-2" style="color: #475569;"></i>
                                        <span style="color: #1e293b;">{{ $notification->topic }}</span>
                                        <small class="ms-auto fw-normal pe-3" style="font-size: 0.75rem; color: #94a3b8;">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </small>
                                    </span>
                                </button>
                            </h2>
                            <div id="collapse-{{ $notification->id }}" 
                                 class="accordion-collapse collapse" 
                                 aria-labelledby="heading-{{ $notification->id }}" 
                                 data-bs-parent="#announcementsAccordion">
                                <div class="accordion-body px-3 py-3 rounded-bottom mt-1 small" style="white-space: pre-line; background: #f8fafc; color: #334155;">
                                    {{ $notification->description }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <style>
        #announcementsAccordion .accordion-button::after {
            filter: none;
        }
        #announcementsAccordion .accordion-button:not(.collapsed) {
            background-color: #e2e8f0;
            color: #1e293b;
            box-shadow: none;
        }
    </style>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            @if($meets->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Meet Title</th>
                                <th>Meet Date</th>
                                <th>Qiraath</th>
                                <th>Welcome Speech</th>
                                <th>Vote of Thanks</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($meets as $meet)
                                <tr>
                                    <td class="ps-4 fw-medium text-dark">{{ $meet->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($meet->meet_date)->format('d M Y') }}</td>
                                    <td>{{ $meet->qiraath ?: '—' }}</td>
                                    <td>{{ $meet->welcome_speech ?: '—' }}</td>
                                    <td>{{ $meet->vote_of_thanks ?: '—' }}</td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group">
                                            <a href="{{ route('institution.talents-meet.show', $meet->id) }}" class="btn btn-sm btn-outline-info" title="View Details">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                            <a href="{{ route('institution.talents-meet.edit', $meet->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('institution.talents-meet.destroy', $meet->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this program list?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-end p-3">
                    {{ $meets->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-music-note-beamed text-muted opacity-50" style="font-size: 4rem;"></i>
                    </div>
                    <h5 class="text-dark">No Program Lists Created</h5>
                    <p class="text-muted small px-3">Prepare your weekly Talents Meet by scheduling qiraath, addresses, talks, songs, and speeches.</p>
                    <a href="{{ route('institution.talents-meet.create') }}" class="btn btn-primary mt-2">
                        Create First Program List
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
