@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Toggle Data Collection Section</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.feature_flags.update') }}" method="POST">
        @csrf
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="is_active" id="is_active" value="1" {{ $flag->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Activate Data Collection Section</label>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save</button>
    </form>
</div>
@endsection
