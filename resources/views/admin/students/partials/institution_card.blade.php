<div class="card mb-4 shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ $institution->name }}</h5>
        <small>{{ $institution->email }}</small>
    </div>
    <div class="card-body">
        {{-- 🏢 Organization Details --}}
        @php
            $org = $institution->organization;
            $instData = $institution->institutionData;
        @endphp

        <div class="row mb-4">
            <div class="col-12">
                <div class="p-3 bg-light rounded border border-light-subtle shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="text-primary mb-0 fw-bold">
                            <i class="bi bi-building me-1"></i> Organization Details
                        </h6>
                        <div>
                            @if($org)
                                <span class="badge bg-success me-1">Organization Details Saved</span>
                            @else
                                <span class="badge bg-secondary me-1">No Organization Details</span>
                            @endif
                            
                            @if($instData)
                                <span class="badge bg-info text-dark">Organization Data Saved</span>
                            @else
                                <span class="badge bg-secondary">No Organization Data</span>
                            @endif
                        </div>
                    </div>

                    @if($org || $instData)
                        <div class="row g-3">
                            {{-- Standard Organization --}}
                            @if($org)
                                <div class="col-md-6">
                                    <div class="card h-100 border-0 bg-white shadow-sm p-3">
                                        <h6 class="fw-bold text-dark border-bottom pb-2 mb-2">
                                            <i class="bi bi-shield-check text-success me-1"></i> Students' Organization
                                        </h6>
                                        <div class="row g-2 small">
                                            <div class="col-6">
                                                <span class="text-muted d-block" style="font-size: 0.75rem;">Organization Name</span>
                                                <span class="fw-semibold text-dark">{{ $org->organization_name }}</span>
                                            </div>
                                            <div class="col-6">
                                                <span class="text-muted d-block" style="font-size: 0.75rem;">Affiliation No</span>
                                                <span class="fw-semibold text-dark">{{ $org->affiliation_number }}</span>
                                            </div>
                                            <div class="col-6">
                                                <span class="text-muted d-block" style="font-size: 0.75rem;">Contact Number</span>
                                                <span class="fw-semibold text-dark">{{ $org->contact_number }}</span>
                                            </div>
                                            <div class="col-6">
                                                <span class="text-muted d-block" style="font-size: 0.75rem;">Mail ID</span>
                                                <span class="fw-semibold text-dark">{{ $org->email }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Data Collection (Institution Data) --}}
                            @if($instData)
                                <div class="col-md-6">
                                    <div class="card h-100 border-0 bg-white shadow-sm p-3">
                                        <h6 class="fw-bold text-dark border-bottom pb-2 mb-2">
                                            <i class="bi bi-collection text-info me-1"></i> Data Collection Details
                                        </h6>
                                        <div class="row g-2 small">
                                            <div class="col-12">
                                                <span class="text-muted d-block" style="font-size: 0.75rem;">Org Full Name</span>
                                                <span class="fw-semibold text-dark">{{ $instData->college_organization_full_name }} ({{ $instData->college_organization_short_name }})</span>
                                            </div>
                                            <div class="col-4">
                                                <span class="text-muted d-block" style="font-size: 0.75rem;">Chairman</span>
                                                <span class="fw-semibold text-dark">{{ $instData->chairman_name }}</span>
                                                <span class="text-muted d-block" style="font-size: 0.7rem;">{{ $instData->chairman_contact }}</span>
                                            </div>
                                            <div class="col-4">
                                                <span class="text-muted d-block" style="font-size: 0.75rem;">Convener</span>
                                                <span class="fw-semibold text-dark">{{ $instData->convener_name }}</span>
                                                <span class="text-muted d-block" style="font-size: 0.7rem;">{{ $instData->convener_contact }}</span>
                                            </div>
                                            <div class="col-4">
                                                <span class="text-muted d-block" style="font-size: 0.75rem;">Treasurer</span>
                                                <span class="fw-semibold text-dark">{{ $instData->treasurer_name }}</span>
                                                <span class="text-muted d-block" style="font-size: 0.7rem;">{{ $instData->treasurer_contact }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <p class="text-muted small mb-0 p-2 text-center bg-white rounded border border-dashed">
                            No organization details or data collection info submitted yet.
                        </p>
                    @endif
                </div>
            </div>
        </div>

        @if($institution->students->isEmpty())
            <p class="text-muted">No students added yet.</p>
        @else
            {{-- 📥 Export This College --}}
            <div class="mb-3 d-flex justify-content-end">
                <a href="{{ route('admin.students.exportByInstitution', $institution->id) }}" class="btn btn-outline-success btn-sm">
                    📥 Export {{ $institution->name }} Students
                </a>
            </div>

            @php
                // Group students by class
                $studentsByClass = $institution->students->groupBy('class');
            @endphp

            @foreach($studentsByClass as $className => $students)
                <h5 class="mt-4 mb-3 text-primary">📌 Class: {{ $className }}</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
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
                                        <form action="{{ route('admin.student.updateStatus', $student->id) }}" method="POST" class="d-flex gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-select form-select-sm w-auto">
                                                <option value="pending" {{ $student->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="verified" {{ $student->status == 'verified' ? 'selected' : '' }}>Verified</option>
                                                <option value="working_fund" {{ $student->status == 'working_fund' ? 'selected' : '' }}>Working Fund</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary">✔</button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#studentModal{{ $student->id }}">
                                            <i class="bi bi-eye"></i> Details
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal for Student Details -->
                                <div class="modal fade" id="studentModal{{ $student->id }}" tabindex="-1" aria-labelledby="studentModalLabel{{ $student->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content border-0 shadow-lg rounded-4">
                                            <div class="modal-header bg-primary text-white rounded-top-4">
                                                <h5 class="modal-title" id="studentModalLabel{{ $student->id }}">
                                                    <i class="bi bi-person-badge-fill me-2"></i> Student Details: {{ $student->name }}
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4 text-start">
                                                <div class="row">
                                                    {{-- Student Photo (Optional) --}}
                                                    <div class="col-md-4 text-center mb-3 mb-md-0 border-end">
                                                        @if($student->photo)
                                                            <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo" class="img-fluid rounded-3 shadow-sm mb-3" style="max-height: 200px; object-fit: cover;">
                                                        @else
                                                            <div class="bg-light rounded-3 d-flex flex-column align-items-center justify-content-center border" style="height: 200px;">
                                                                <i class="bi bi-person-fill text-muted" style="font-size: 5rem;"></i>
                                                                <span class="text-muted small">No photo uploaded</span>
                                                            </div>
                                                        @endif
                                                        <h6 class="mt-3 fw-bold text-dark">{{ $student->name }}</h6>
                                                        <span class="badge bg-primary px-3 py-2 mt-1">{{ $student->class }} - {{ ucfirst($student->stream) }}</span>
                                                    </div>
                                                    
                                                    {{-- Student Details --}}
                                                    <div class="col-md-8">
                                                        <div class="row g-3">
                                                            <div class="col-sm-6">
                                                                <small class="text-muted d-block">UID</small>
                                                                <strong class="text-dark">{{ $student->uid }}</strong>
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
                                                                <strong class="text-dark">{{ $student->contact_number ?? '—' }}</strong>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <small class="text-muted d-block">WhatsApp Number</small>
                                                                <strong class="text-dark">{{ $student->whatsapp_number ?? '—' }}</strong>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <small class="text-muted d-block">Date of Birth</small>
                                                                <strong class="text-dark">
                                                                    {{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('d M Y') : '—' }}
                                                                </strong>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <small class="text-muted d-block">Place</small>
                                                                <strong class="text-dark">{{ $student->place ?? '—' }}</strong>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <small class="text-muted d-block">Constituency</small>
                                                                <strong class="text-dark">{{ $student->constituency ?? '—' }}</strong>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <small class="text-muted d-block">District</small>
                                                                <strong class="text-dark">{{ $student->district ?? '—' }}</strong>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <small class="text-muted d-block">State</small>
                                                                <strong class="text-dark">{{ $student->state ?? '—' }}</strong>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <small class="text-muted d-block">Country</small>
                                                                <strong class="text-dark">{{ $student->country ?? '—' }}</strong>
                                                            </div>
                                                            <div class="col-12">
                                                                <small class="text-muted d-block mb-1"><i class="bi bi-stars text-warning me-1"></i> Interested Areas</small>
                                                                @if(!empty($student->interested_areas))
                                                                    <div class="d-flex flex-wrap gap-1 mt-1">
                                                                        @foreach($student->interested_areas as $area)
                                                                            <span class="badge rounded-pill px-3 py-2"
                                                                                  style="background: #e8f4ff; color: #0a58ca; border: 1px solid #b8d8f8; font-size: 0.75rem; font-weight: 500;">
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
                                                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
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
