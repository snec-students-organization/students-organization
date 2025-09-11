@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 p-3 bg-primary text-white rounded shadow-sm">
        <h1 class="h4 mb-2 mb-sm-0">
            <i class="bi bi-calendar-event-fill me-2"></i> Upcoming Events
        </h1>
        <a href="{{ route('admin.upcoming-events.create') }}" class="btn btn-light btn-sm shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Add New Event
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Events Table --}}
    @if($events->count())
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Photo</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Description</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}" 
                                         alt="{{ $event->title }}" 
                                         class="img-thumbnail" style="max-width: 100px;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $event->title }}</td>
                            <td>{{ optional($event->date)->format('F j, Y') ?? '-' }}</td>
                            <td>{{ $event->location }}</td>
                            <td>{{ Str::limit($event->description, 50) }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.upcoming-events.edit', $event) }}" 
                                   class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.upcoming-events.destroy', $event) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this event?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info shadow-sm">
            <i class="bi bi-info-circle-fill me-1"></i> No upcoming events found.
        </div>
    @endif

</div>
@endsection
