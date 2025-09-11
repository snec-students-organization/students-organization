@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 p-3 bg-primary text-white rounded shadow-sm">
        <h1 class="h4 mb-2 mb-sm-0">
            <i class="bi bi-pencil-square me-2"></i> Edit Upcoming Event
        </h1>
        <a href="{{ route('admin.upcoming-events.index') }}" class="btn btn-outline-light btn-sm shadow-sm">
            <i class="bi bi-arrow-left-circle me-1"></i> Back
        </a>
    </div>

    {{-- Form Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @include('admin.upcoming-events.form', ['event' => $event])
        </div>
    </div>

</div>
@endsection
