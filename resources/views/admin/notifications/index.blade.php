@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 p-3 bg-primary text-white rounded shadow-sm">
        <h1 class="h4 mb-2 mb-sm-0">
            <i class="bi bi-bell-fill me-2"></i> Notifications
        </h1>
        <a href="{{ route('admin.notifications.create') }}" class="btn btn-light btn-sm shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Create New Notification
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Notifications Table --}}
    @if($notifications->count())
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Visible To</th>
                        <th>Event</th>
                        <th>PDF</th>
                        <th>Created At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $notification)
                        <tr>
                            <td class="fw-semibold">{{ $notification->title }}</td>
                            <td>
                                <span class="badge 
                                    {{ $notification->user_type === 'admin' ? 'bg-danger' : 
                                       ($notification->user_type === 'user' ? 'bg-info' : 'bg-success') }}">
                                    {{ ucfirst($notification->user_type) }}
                                </span>
                            </td>
                            <td>{{ $notification->event ? $notification->event->title : '-' }}</td>
                            <td>
                                @if($notification->pdf_path)
                                    <a href="{{ asset('storage/' . $notification->pdf_path) }}" target="_blank" class="text-decoration-none">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger me-1"></i> View PDF
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $notification->created_at->format('Y-m-d') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.notifications.edit', $notification) }}" 
                                   class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.notifications.destroy', $notification) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this notification?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $notifications->links() }}
        </div>
    @else
        <div class="alert alert-info shadow-sm">
            <i class="bi bi-info-circle-fill me-1"></i> No notifications found.
        </div>
    @endif
</div>
@endsection