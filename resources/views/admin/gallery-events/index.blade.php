@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 p-3 bg-primary text-white rounded shadow-sm">
        <h1 class="h4 mb-2 mb-sm-0">
            <i class="bi bi-images me-2"></i> Gallery Events
        </h1>
        <div class="d-flex gap-2">
            {{-- Back Button --}}
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm shadow-sm">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
            {{-- Add Event Button --}}
            <a href="{{ route('admin.gallery-events.create') }}" class="btn btn-light btn-sm shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Add New Event
            </a>
        </div>
    </div>

    {{-- Events Table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>Name</th>
                            <th>Cover Image</th>
                            <th>Marked</th>
                            <th class="text-center" style="width: 250px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                            <tr>
                                <td class="fw-semibold">{{ $event->name }}</td>
                                <td>
                                    @if($event->cover_image)
                                        <img src="{{ asset('storage/' . $event->cover_image) }}" 
                                             alt="{{ $event->name }}" 
                                             class="rounded shadow-sm border"
                                             style="width: 120px; height: auto;">
                                    @else
                                        <span class="text-muted">No cover image</span>
                                    @endif
                                </td>
                                <td>
                                    @if($event->marked)
                                        <span class="badge bg-success">Marked</span>
                                    @else
                                        <span class="badge bg-secondary">Not Marked</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{-- Mark/Unmark --}}
                                    <form action="{{ route('admin.gallery-events.mark', $event->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-sm {{ $event->marked ? 'btn-success' : 'btn-secondary' }}">
                                            {{ $event->marked ? 'Unmark' : 'Mark' }}
                                        </button>
                                    </form>

                                    {{-- View Images --}}
                                    <a href="{{ route('admin.gallery-events.images.index', $event->id) }}" 
                                       class="btn btn-sm btn-info mb-1">
                                        <i class="bi bi-images"></i>
                                    </a>

                                    {{-- Add Image --}}
                                    <a href="{{ route('admin.gallery-events.images.create', $event->id) }}" 
                                       class="btn btn-sm btn-success mb-1">
                                        <i class="bi bi-plus-circle"></i>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.gallery-events.edit', $event->id) }}" 
                                       class="btn btn-sm btn-warning mb-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.gallery-events.destroy', $event->id) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Delete this event?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
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