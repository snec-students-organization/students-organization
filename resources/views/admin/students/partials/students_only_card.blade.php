{{--
Partial: students_only_card.blade.php
Shows ONLY the students table for an institution (no org details section).
Used in the "Students" tab of boys/girls dashboards.
--}}
<div class="card mb-4 shadow-sm border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-2">
        <div>
            <h6 class="mb-0 fw-bold">{{ $institution->name }}</h6>
            <small class="opacity-75">{{ $institution->email }}</small>
        </div>
        <div class="d-flex gap-2 align-items-center">
            @php $total = $institution->students->count();
            $verified = $institution->students->where('status', 'verified')->count(); @endphp
            <span class="badge bg-white text-primary">{{ $total }} Students</span>
            <span class="badge bg-success">{{ $verified }} Verified</span>
        </div>
    </div>
    <div class="card-body p-3">
        @if($institution->students->isEmpty())
            <p class="text-muted text-center py-3 mb-0">
                <i class="bi bi-person-x me-1"></i> No students added yet.
            </p>
        @else
            {{-- 📥 Export This College --}}
            <div class="mb-3 d-flex justify-content-end">
                <a href="{{ route('admin.students.exportByInstitution', $institution->id) }}"
                    class="btn btn-outline-success btn-sm">
                    <i class="bi bi-download me-1"></i> Export {{ $institution->name }} Students
                </a>
            </div>

            @php
                $studentsByClass = $institution->students->groupBy('class');
            @endphp

            @foreach($studentsByClass as $className => $students)
                <h6 class="mt-3 mb-2 text-primary fw-bold">
                    <i class="bi bi-bookmark-fill me-1"></i> Class: {{ $className }}
                </h6>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-2">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Update</th>
                                <th class="text-center">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>
                                        <span class="badge
                                                        @if($student->status == 'pending') bg-warning text-dark
                                                        @elseif($student->status == 'verified') bg-success
                                                        @else bg-info text-dark @endif">
                                            {{ ucfirst($student->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.student.updateStatus', $student->id) }}" method="POST"
                                            class="d-flex gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-select form-select-sm w-auto">
                                                <option value="pending" {{ $student->status == 'pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="verified" {{ $student->status == 'verified' ? 'selected' : '' }}>
                                                    Verified</option>
                                                <option value="working_fund" {{ $student->status == 'working_fund' ? 'selected' : '' }}>Working Fund</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary">✔</button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                            data-bs-target="#studentModal{{ $student->id }}">
                                            <i class="bi bi-eye"></i> Details
                                        </button>
                                    </td>
                                </tr>

                                {{-- Student Details Modal --}}
                                <div class="modal fade" id="studentModal{{ $student->id }}" tabindex="-1"
                                    aria-labelledby="studentModalLabel{{ $student->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content border-0 shadow-lg rounded-4">
                                            <div class="modal-header bg-primary text-white rounded-top-4">
                                                <h5 class="modal-title" id="studentModalLabel{{ $student->id }}">
                                                    <i class="bi bi-person-badge-fill me-2"></i> Student Details:
                                                    {{ $student->name }}
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4 text-start">
                                                <div class="row">
                                                    {{-- Photo --}}
                                                    <div class="col-md-4 text-center mb-3 mb-md-0 border-end">
                                                        @if($student->photo)
                                                            <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo"
                                                                class="img-fluid rounded-3 shadow-sm mb-3"
                                                                style="max-height:200px;object-fit:cover;">
                                                        @else
                                                            <div class="bg-light rounded-3 d-flex flex-column align-items-center justify-content-center border"
                                                                style="height:200px;">
                                                                <i class="bi bi-person-fill text-muted" style="font-size:5rem;"></i>
                                                                <span class="text-muted small">No photo uploaded</span>
                                                            </div>
                                                        @endif
                                                        <h6 class="mt-3 fw-bold text-dark">{{ $student->name }}</h6>
                                                        <span class="badge bg-primary px-3 py-2 mt-1">{{ $student->class }} -
                                                            {{ ucfirst($student->stream) }}</span>
                                                    </div>

                                                    {{-- Details --}}
                                                    <div class="col-md-8">
                                                        <div class="row g-3">
                                                            <div class="col-sm-6">
                                                                <small class="text-muted d-block">UID</small>
                                                                <strong>{{ $student->uid }}</strong>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <small class="text-muted d-block">Membership Number</small>
                                                                <strong
                                                                    class="text-success">{{ $student->membership_number ?? '—' }}</strong>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <small class="text-muted d-block">Status</small>
                                                                <span class="badge
                                                                                @if($student->status == 'pending') bg-warning text-dark
                                                                                @elseif($student->status == 'verified') bg-success
                                                                                @else bg-info text-dark @endif">
                                                                    {{ ucfirst($student->status) }}
                                                                </span>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <small class="text-muted d-block">Contact Number</small>
                                                                <strong>{{ $student->contact_number ?? '—' }}</strong>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <small class="text-muted d-block">WhatsApp Number</small>
                                                                <strong>{{ $student->whatsapp_number ?? '—' }}</strong>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <small class="text-muted d-block">Date of Birth</small>
                                                                <strong>{{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('d M Y') : '—' }}</strong>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <small class="text-muted d-block">Place</small>
                                                                <strong>{{ $student->place ?? '—' }}</strong>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <small class="text-muted d-block">Constituency</small>
                                                                <strong>{{ $student->constituency ?? '—' }}</strong>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <small class="text-muted d-block">District</small>
                                                                <strong>{{ $student->district ?? '—' }}</strong>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <small class="text-muted d-block">State</small>
                                                                <strong>{{ $student->state ?? '—' }}</strong>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <small class="text-muted d-block">Country</small>
                                                                <strong>{{ $student->country ?? '—' }}</strong>
                                                            </div>
                                                            <div class="col-12">
                                                                <small class="text-muted d-block mb-1">
                                                                    <i class="bi bi-stars text-warning me-1"></i> Interested Areas
                                                                </small>
                                                                @if(!empty($student->interested_areas))
                                                                    <div class="d-flex flex-wrap gap-1 mt-1">
                                                                        @foreach($student->interested_areas as $area)
                                                                            <span class="badge rounded-pill px-3 py-2"
                                                                                style="background:#e8f4ff;color:#0a58ca;border:1px solid #b8d8f8;font-size:0.75rem;">
                                                                                <i class="bi bi-check-circle-fill me-1"></i>{{ $area }}
                                                                            </span>
                                                                        @endforeach
                                                                    </div>
                                                                @else
                                                                    <span class="text-muted small">— Not specified</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light rounded-bottom-4">
                                                <button type="button" class="btn btn-secondary px-4"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        @endif
    </div>
</div>