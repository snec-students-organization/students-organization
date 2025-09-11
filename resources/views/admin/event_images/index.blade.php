@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 p-3 bg-primary text-white rounded shadow-sm">
        <h1 class="h4 mb-2 mb-sm-0">
            <i class="bi bi-images me-2"></i> Images for: {{ $event->name }}
        </h1>
        <div class="d-flex gap-2">
            {{-- Back Button --}}
            <a href="{{ route('admin.gallery-events.index') }}" class="btn btn-outline-light btn-sm shadow-sm">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
            {{-- Add New Image --}}
            <a href="{{ route('admin.gallery-events.images.create', $event->id) }}" class="btn btn-light btn-sm shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Add New Image
            </a>
        </div>
    </div>

    {{-- Images Table --}}
    @if($images->count() > 0)
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th style="width: 200px;">Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th class="text-center" style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($images as $image)
                                <tr>
                                    <td>
                                        @if($image->image_path && file_exists(public_path('storage/' . $image->image_path)))
                                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                                 alt="{{ $image->title }}" 
                                                 class="rounded shadow-sm"
                                                 style="max-width: 180px; height: auto;">
                                        @else
                                            <span class="badge bg-secondary">No image</span>
                                        @endif
                                    </td>
                                    <td class="fw-semibold">{{ $image->title }}</td>
                                    <td>{{ $image->description ?? '—' }}</td>
                                    <td class="text-center">
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.gallery-events.images.edit', [$event->id, $image->id]) }}" 
                                           class="btn btn-warning btn-sm me-1" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- Delete --}}
                                        <form action="{{ route('admin.gallery-events.images.destroy', [$event->id, $image->id]) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Delete this image?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $images->links() }}
        </div>

    @else
        <div class="alert alert-info shadow-sm">
            <i class="bi bi-info-circle me-2"></i>
            No images found for this event yet. Click <strong>"Add New Image"</strong> to upload.
        </div>
    @endif
</div>
@endsection