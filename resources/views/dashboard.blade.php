@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">User Dashboard</h1>
    <p class="text-gray-600">Welcome, {{ Auth::user()->name }}!</p>

    @if(Auth::user()->role === 'admin')
        <div class="mt-6">
            <a href="{{ route('admin.dashboard') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                Go to Admin Dashboard
            </a>
        </div>
    @endif
</div>
@endsection

