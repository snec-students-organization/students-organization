@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-5 text-center fw-bold text-primary"> Event Gallery </h2>

    <div class="row g-4">
        @foreach($events as $event)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow-lg gallery-card overflow-hidden rounded-4">
                    <a href="{{ route('gallery.show', $event->id) }}" class="text-decoration-none position-relative d-block">
                        
                        {{-- Event Image --}}
                        <img src="{{ asset('storage/'.$event->cover_image) }}"
                             alt="{{ $event->name }}"
                             class="card-img-top gallery-image">

                        {{-- Overlay --}}
                        <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-center">
                            <span class="badge bg-light text-dark px-3 py-2 fs-6 shadow">View Gallery</span>
                        </div>
                    </a>

                    {{-- Card Body --}}
                    <div class="card-body text-center">
                        <a href="{{ route('gallery.show', $event->id) }}" class="stretched-link text-decoration-none">
                            <h5 class="card-title fw-bold mb-1 text-dark">{{ $event->name }}</h5>
                        </a>
                        <small class="text-muted fst-italic">Click to explore memories</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('styles')
<style>
    .gallery-card {
        transition: transform 0.35s ease, box-shadow 0.35s ease;
    }
    .gallery-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 1.5rem 2.5rem rgba(0, 0, 0, 0.2) !important;
    }
    .gallery-image {
        height: 200px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .gallery-card:hover .gallery-image {
        transform: scale(1.1);
    }
    .gallery-overlay {
        background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.6));
        opacity: 0;
        transition: opacity 0.4s ease;
    }
    .gallery-card:hover .gallery-overlay {
        opacity: 1;
    }
    .card-title {
        transition: color 0.3s ease;
    }
    .gallery-card:hover .card-title {
        color: #0d6efd !important;
    }
</style>
@endpush
@endsection


