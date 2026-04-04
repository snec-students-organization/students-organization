@extends('layouts.app')

@section('title', 'Admission Data Collection')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0 text-gray-800">Admission Data Collection</h2>
            <a href="{{ route('admin.data.collection.admission.export') }}" class="btn btn-success">
                <i class="fas fa-file-excel me-1"></i> Export Excel
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Submitted Applications</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="admissionTable" width="100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>UID No</th>
                                <th>GPay Number</th>
                                <th>College & Contact</th>
                                <th>Reward History</th>
                                <th>Submissions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @forelse($admissions as $uid => $group)
                                @php
                                    $latest = $group->first();
                                    $gpayNumbers = $group->pluck('gpay_number')->filter()->unique();
                                @endphp
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $latest->student_name }}</td>
                                    <td><span class="badge bg-info text-dark">{{ $uid }}</span></td>
                                    <td>
                                        @if($gpayNumbers->count() > 0)
                                            @foreach($gpayNumbers as $gpay)
                                                <div class="fw-bold">{{ $gpay }}</div>
                                            @endforeach
                                        @else
                                            <span class="text-muted small">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="small">{{ $latest->college_name }}</div>
                                        <div class="small text-muted">{{ $latest->contact_number }}</div>
                                    </td>
                                    <td>
                                        @foreach($group as $item)
                                            @if($item->scratch_card_amount)
                                                <div class="mb-1">
                                                    <span class="badge bg-success">₹{{ $item->scratch_card_amount }}</span>
                                                    <small class="text-muted">
                                                        @if($item->is_scratched)
                                                            (Scratched)
                                                        @else
                                                            (Pending)
                                                        @endif
                                                    </small>
                                                </div>
                                            @endif
                                        @endforeach
                                        @if($group->sum('scratch_card_amount') > 0)
                                            <hr class="my-1">
                                            <div class="fw-bold small">Total: ₹{{ $group->sum('scratch_card_amount') }}</div>
                                        @else
                                            <span class="text-muted small">None</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="small text-muted mb-2">Total: {{ $group->count() }}</div>
                                        @foreach($group as $item)
                                            <div class="small mb-1" style="line-height: 1.2;">
                                                <code>{{ $item->application_number }}</code>
                                                <br>
                                                <small>{{ $item->created_at->format('d M y, h:i A') }}</small>
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">No admission data found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($admissions instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="mt-4">
                        {{ $admissions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection