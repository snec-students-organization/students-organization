@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h3 mb-0 text-gray-800">Add Organization</h2>
                        <a href="{{ route('organizations.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>

                    <form action="{{ route('admin.organizations.store') }}" method="POST">
                        @csrf

                        {{-- Include institution dropdown and other inputs --}}
                        @include('organizations.form', ['organization' => null])

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success px-4 py-2">
                                <i class="bi bi-check-lg me-1"></i> Save
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

