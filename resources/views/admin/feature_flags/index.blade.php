@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">⚙️ Feature Flags Dashboard</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Feature</th>
                        <th>Status</th>
                        <th>Toggle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($flags as $flag)
                        <tr>
                            <td><strong>{{ ucfirst(str_replace('_', ' ', $flag->feature_name)) }}</strong></td>
                            <td>
                                <span class="badge {{ $flag->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $flag->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('admin.feature_flags.update', $flag->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-check form-switch">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="is_active"
                                               onchange="this.form.submit()"
                                               {{ $flag->is_active ? 'checked' : '' }}>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
