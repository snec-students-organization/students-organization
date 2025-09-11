@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $event->title ?? 'Event Details' }}</h1>
    
    <p><strong>Date:</strong> {{ $event->date ? $event->date->format('Y-m-d') : 'N/A' }}</p>
    <p><strong>Description:</strong></p>
    <p>{{ $event->description ?? 'No description provided.' }}</p>
    
    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
