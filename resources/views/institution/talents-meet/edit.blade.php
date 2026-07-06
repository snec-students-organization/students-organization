@extends('layouts.institution')

@section('title', 'Edit Weekly Talents Meet')
@section('page-title', 'Edit Weekly Talents Meet')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <a href="{{ route('institution.talents-meet.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
    </div>

    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i> Edit Weekly Talents Meet Program</h5>
        </div>
        <div class="card-body p-4 bg-white">
            <form method="POST" action="{{ route('institution.talents-meet.update', $talentsMeet->id) }}">
                @csrf
                @method('PUT')

                {{-- Basic Information --}}
                <div class="row g-3 mb-4">
                    <h5 class="text-primary border-bottom pb-2">📅 Meet Details</h5>
                    <div class="col-md-8">
                        <label for="title" class="form-label fw-semibold">Meet Title / Week Name <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="e.g. Weekly Talents Meet - Week 1" value="{{ old('title', $talentsMeet->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="meet_date" class="form-label fw-semibold">Meet Date <span class="text-danger">*</span></label>
                        <input type="date" name="meet_date" id="meet_date" class="form-control @error('meet_date') is-invalid @enderror" value="{{ old('meet_date', $talentsMeet->meet_date) }}" required>
                        @error('meet_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Agenda & Program list --}}
                <div class="row g-3">
                    <h5 class="text-primary border-bottom pb-2 mt-4">📋 Program Agenda & Speakers</h5>
                    
                    <div class="col-md-6">
                        <label for="qiraath" class="form-label fw-semibold">Qiraath (Reciter name)</label>
                        <input type="text" name="qiraath" id="qiraath" class="form-control" placeholder="Enter name of reciter" value="{{ old('qiraath', $talentsMeet->qiraath) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="welcome_speech" class="form-label fw-semibold">Welcome Speech (Presenter name)</label>
                        <input type="text" name="welcome_speech" id="welcome_speech" class="form-control" placeholder="Enter name of welcoming person" value="{{ old('welcome_speech', $talentsMeet->welcome_speech) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="presidential_address" class="form-label fw-semibold">Presidential Address (Speaker name)</label>
                        <input type="text" name="presidential_address" id="presidential_address" class="form-control" placeholder="Enter name of president/speaker" value="{{ old('presidential_address', $talentsMeet->presidential_address) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="inauguration_talk" class="form-label fw-semibold">Inauguration Talk (Inaugurator name)</label>
                        <input type="text" name="inauguration_talk" id="inauguration_talk" class="form-control" placeholder="Enter name of inaugurator" value="{{ old('inauguration_talk', $talentsMeet->inauguration_talk) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="speeches" class="form-label fw-semibold">Speeches (Names & Topics)</label>
                        <textarea name="speeches" id="speeches" class="form-control" rows="3" placeholder="Enter other speeches (e.g. 1. Name - Topic)">{{ old('speeches', $talentsMeet->speeches) }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="songs" class="form-label fw-semibold">Songs (Names & Performers)</label>
                        <textarea name="songs" id="songs" class="form-control" rows="3" placeholder="Enter songs/performances (e.g. 1. Name - Song type)">{{ old('songs', $talentsMeet->songs) }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="vote_of_thanks" class="form-label fw-semibold">Vote of Thanks (Presenter name)</label>
                        <input type="text" name="vote_of_thanks" id="vote_of_thanks" class="form-control" placeholder="Enter name of vote of thanks presenter" value="{{ old('vote_of_thanks', $talentsMeet->vote_of_thanks) }}">
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top d-flex gap-2">
                    <button type="submit" class="btn btn-primary fw-semibold px-4">
                        Update Program List
                    </button>
                    <a href="{{ route('institution.talents-meet.index') }}" class="btn btn-outline-secondary px-4">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
