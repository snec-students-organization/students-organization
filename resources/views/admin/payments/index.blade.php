@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Payments</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Type</th>
                <th>College / Institution</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Screenshot</th>
                <th>Extra Info</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
            <tr>
                <td>{{ ucfirst($payment->type) }}</td>
                <td>{{ $payment->college_name ?? $payment->institution_name }}</td>
                <td>{{ $payment->name ?? 'Institution Payment' }}</td>
                <td>₹ {{ number_format($payment->amount, 2) }}</td>
                <td>
                    @if($payment->screenshot_path)
                        @php
                            $filePath = storage_path('app/public/'.$payment->screenshot_path);
                        @endphp

                        @if(file_exists($filePath))
                            <a href="{{ asset('storage/'.$payment->screenshot_path) }}" target="_blank">
                                <img src="{{ asset('storage/'.$payment->screenshot_path) }}" 
                                     alt="Screenshot" 
                                     width="100" 
                                     class="img-thumbnail mb-2">
                            </a>
                            <br>
                            <a href="{{ asset('storage/'.$payment->screenshot_path) }}" 
                               download 
                               class="btn btn-sm btn-outline-primary">
                                Download
                            </a>
                        @else
                            <span class="text-warning">File uploaded but missing/inaccessible</span>
                        @endif
                    @else
                        <span class="text-muted">No Screenshot</span>
                    @endif
                </td>
                <td>
                    @if($payment->type === 'user')
                        <b>UID:</b> {{ $payment->uid_number }} <br>
                        <b>Class:</b> {{ $payment->class }}
                    @else
                        <b>No. of Students:</b> {{ $payment->no_of_students }} <br>
                        <b>Paid UIDs:</b> 
                        {{ $payment->paid_students_uid ? implode(', ', json_decode($payment->paid_students_uid, true)) : 'N/A' }}
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">No payments found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection



