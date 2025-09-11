@extends('layouts.app') {{-- or your public layout --}}

@section('content')
<div class="container py-5">

    {{-- Event Title --}}
    <h1 class="mb-5 text-center fw-bold text-primary">{{ $event->name }}</h1>

    @if($images->count() > 0)
        <div class="row g-4">
            @foreach($images as $image)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden gallery-card">
                        
                        {{-- Image --}}
                        @if($image->image_path && file_exists(public_path('storage/' . $image->image_path)))
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                     alt="{{ $image->title }}" 
                                     class="card-img-top gallery-image">

                                
                            </div>
                        @else
                            <div class="p-5 text-center text-muted">No image</div>
                        @endif

                        {{-- Card Body --}}
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold text-dark mb-1">{{ $image->title }}</h5>
                            @if($image->description)
                                <p class="card-text text-muted small">{{ $image->description }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center py-4 rounded-3 shadow-sm">
            No images available for this event.
        </div>
    @endif
</div>

@push('styles')
<style>
    .gallery-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .gallery-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.15) !important;
    }
    .gallery-image {
        height: 220px;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .gallery-card:hover .gallery-image {
        transform: scale(1.1);
    }
    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.4);
        opacity: 0;
        transition: opacity 0.4s ease;
    }
    .gallery-card:hover .gallery-overlay {
        opacity: 1;
    }
</style>
@endpush
@endsection
