@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Notifications</h5>
        </div>

        <div class="card-body p-0">
            @if($notifications->count())
                <ul class="list-group list-group-flush">
                    @foreach($notifications as $notification)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="fw-bold mb-1">{{ $notification->title }}</h6>
                                <small class="text-muted d-block">{{ $notification->created_at->diffForHumans() }}</small>
                                <p class="mb-1">{{ $notification->message }}</p>

                                @if($notification->pdf_path)
                                    <a href="{{ asset('storage/' . $notification->pdf_path) }}" 
                                       target="_blank" 
                                       class="btn btn-sm btn-outline-primary">
                                        View PDF
                                    </a>
                                @endif
                            </div>

                            @if(!$notification->read_at)
                                <span class="badge bg-success align-self-center">New</span>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <div class="card-footer d-flex justify-content-center">
                    {{ $notifications->links() }}
                </div>
            @else
                <div class="p-3 text-center text-muted">
                    No notifications available.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
