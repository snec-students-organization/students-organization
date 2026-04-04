@extends('layouts.app')

@section('title', 'Scratch Card Payments')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0 text-gray-800">Scratch Card Payments</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pending & Processed Payments</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="paymentsTable" width="100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>UID No</th>
                                <th>Contact Number</th>
                                <th>GPay Number</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->student_name }}</td>
                                    <td><span class="badge bg-info text-dark">{{ $payment->uid_no }}</span></td>
                                    <td>{{ $payment->contact_number }}</td>
                                    <td class="fw-bold">{{ $payment->gpay_number ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-success">₹{{ $payment->scratch_card_amount }}</span>
                                    </td>
                                    <td>
                                        @if($payment->is_paid)
                                            <span class="badge bg-primary">Paid</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$payment->is_paid)
                                            <form action="{{ route('admin.scratch_card_payments.mark_as_paid', $payment->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to mark this as paid?')">
                                                    Mark as Paid
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-sm btn-secondary" disabled>
                                                Already Paid
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">No scratch card payments found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($payments instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="mt-4">
                        {{ $payments->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
