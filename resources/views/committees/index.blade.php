@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Main Committee Section --}}
<div class="main-committee-section mb-5">
    <div class="text-center mb-5">
        <h2 class="display-4 fw-bold text-primary position-relative d-inline-block">
            Main Committee
            <span class="position-absolute bottom-0 start-50 translate-middle-x bg-primary rounded" style="height: 4px; width: 80px;"></span>
        </h2>
        <p class="text-muted mt-3">Meet our dedicated leadership team</p>
    </div>
    
    <div class="row justify-content-center">
        @forelse($mainCommittee as $member)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card committee-card border-0 shadow-lg h-100 hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="image-container mb-4">
                            <img src="{{ $member->image ? asset('storage/'.$member->image) : asset('images/default-avatar.png') }}" 
                                 class="img-fluid rounded-box member-photo shadow" 
                                 width="140" 
                                 alt="{{ $member->name }}">
                            <div class="photo-overlay rounded-circle"></div>
                        </div>
                        <h5 class="card-title fw-bold text-dark">{{ $member->name }}</h5>
                        <div class="position-text mb-2">
                            <span class="badge bg-primary rounded-pill px-3 py-2">{{ $member->position }}</span>
                        </div>
                        <p class="card-text text-muted">
                            <i class="fas fa-university me-2"></i>{{ $member->college_name ?? 'Not specified' }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <p class="text-muted fs-5">No members found in Main Committee.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<div class="divider py-4">
    <div class="line bg-gradient-primary"></div>
    <div class="icon-circle bg-primary text-white mx-3">
        <i class="fas fa-star"></i>
    </div>
    <div class="line bg-gradient-primary"></div>
</div>

{{-- Sub Committees Section --}}
<div class="sub-committee-section mt-5">
    <div class="text-center mb-5">
        <h2 class="display-4 fw-bold text-primary position-relative d-inline-block">
            Sub Committees
            <span class="position-absolute bottom-0 start-50 translate-middle-x bg-primary rounded" style="height: 4px; width: 80px;"></span>
        </h2>
        <p class="text-muted mt-3">Our specialized teams working behind the scenes</p>
    </div>
    
    @forelse($subCommittees as $subName => $members)
        <div class="sub-committee-group mb-5">
            <h3 class="mb-4 text-center sub-committee-title">
                <span class="bg-primary text-white px-4 py-2 rounded-pill">{{ ucfirst(str_replace('_', ' ', $subName)) }}</span>
            </h3>
            <div class="row justify-content-center">
                @forelse($members as $member)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <div class="card committee-card border-0 shadow-sm h-100 hover-lift">
                            <div class="card-body text-center p-4">
                                <div class="image-container mb-4">
                                    <img src="{{ $member->image ? asset('storage/'.$member->image) : asset('images/default-avatar.png') }}" 
                                         class="img-fluid rounded-box member-photo shadow" 
                                         width="120" 
                                         alt="{{ $member->name }}">
                                    <div class="photo-overlay rounded-circle"></div>
                                </div>
                                <h5 class="card-title fw-bold text-dark">{{ $member->name }}</h5>
                                <div class="position-text mb-2">
                                    <span class="badge bg-secondary rounded-pill px-3 py-2">{{ $member->position }}</span>
                                </div>
                                <p class="card-text text-muted">
                                    <i class="fas fa-university me-2"></i>{{ $member->college_name ?? 'Not specified' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-4">
                            <i class="fas fa-user-slash fa-2x text-muted mb-2"></i>
                            <p class="text-muted">No members in this sub-committee.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                <p class="text-muted fs-5">No sub-committees found.</p>
            </div>
        </div>
    @endforelse
</div>
@endsection
<style>
    /* Rounded box photo */
.rounded-box {
    border-radius: 15px;   /* Adjust curve - bigger value = more rounded */
    object-fit: cover;     /* Keeps the aspect ratio while filling */
    width: 140px;          /* Ensures same size */
    height: 140px;
}

</style>