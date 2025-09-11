@extends('layouts.app')

@section('title', 'Manage Events')

@section('content')
<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 p-3 bg-primary text-white rounded shadow-sm">
        <h2 class="h4 mb-2 mb-sm-0">
            <i class="bi bi-calendar-event me-2"></i> Manage Events
        </h2>
        <div class="d-flex gap-2">
            {{-- Back Button --}}
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm shadow-sm">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
            {{-- Add Event Button --}}
            <a href="{{ route('admin.events.create') }}" class="btn btn-light btn-sm shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Add Event
            </a>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Events Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>Title</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Description</th>
                            <th class="text-center" style="width: 180px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                        <tr>
                            <td class="fw-semibold">{{ $event->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->start)->format('d M Y, h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->end)->format('d M Y, h:i A') }}</td>
                            <td>{{ Str::limit($event->description, 50) }}</td>
                            <td class="text-center">
                                {{-- Edit --}}
                                <a href="{{ route('admin.events.edit', $event->id) }}" 
                                   class="btn btn-warning btn-sm me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                {{-- Delete --}}
                                <form action="{{ route('admin.events.destroy', $event->id) }}" 
                                      method="POST" 
                                      style="display:inline-block;"
                                      onsubmit="return confirm('Are you sure you want to delete this event?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-calendar-x fs-3 d-block mb-2"></i>No events found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection