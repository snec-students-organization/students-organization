@extends('layouts.app')

@section('content')
<section class="about-section py-5">
    <div class="container">
        <!-- Hero Section -->
<div class="row justify-content-center mb-5">
    <div class="col-lg-10">
        <div class="hero-section text-center rounded-4 shadow-lg">
            <h1 class="fw-bold display-4 mb-3">About SSO</h1>
            <div class="divider mx-auto mb-4"></div>
            <p class="lead mb-0">
                Empowering students through leadership, community, and growth
            </p>
        </div>
    </div>
</div>


        <!-- Who We Are -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-5">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h2 class="h3 fw-semibold mb-3 text-primary">Who We Are</h2>
                                <p class="lead">
                                    The <strong class="text-primary">SNEC Students Organization (SSO)</strong> is the official, student-run governing body
                                    dedicated to fostering holistic student development, leadership, and community engagement at
                                    Sinhgad National Educational Complex.
                                </p>
                                <p>
                                    We serve as the central hub for all student organizations, events, and activities at our institution,
                                    working to embody the vision of molding a generation of ideal scholars equipped with both secular
                                    and spiritual education.
                                </p>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="about-icon bg-primary rounded-circle d-inline-flex align-items-center justify-content-center p-4">
                                    <i class="fas fa-users fa-3x text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-5">
                        <h2 class="h3 fw-semibold mb-4 text-center text-primary">Our Mission & Vision</h2>
                        <p class="text-center mb-4">
                            Our mission is to empower students by providing opportunities for skill development, networking,
                            and collaborative projects that align with SNEC's broader educational goals.
                        </p>
                        
                        <div class="row mt-4">
                            <div class="col-md-6 mb-4">
                                <div class="mission-card h-100 p-4 rounded-3 border-start border-4 border-primary">
                                    <h4 class="h5 fw-semibold mb-3">Our Mission</h4>
                                    <ul class="list-unstyled ps-0">
                                        <li class="mb-2 d-flex align-items-start">
                                            <span class="bg-primary rounded-circle p-2 me-3 d-flex align-items-center justify-content-center">
                                                <i class="fas fa-check text-white small"></i>
                                            </span>
                                            Create a community of professionals who uphold Islamic values and ideals
                                        </li>
                                        <li class="mb-2 d-flex align-items-start">
                                            <span class="bg-primary rounded-circle p-2 me-3 d-flex align-items-center justify-content-center">
                                                <i class="fas fa-check text-white small"></i>
                                            </span>
                                            Develop a research-oriented approach to education and knowledge domains
                                        </li>
                                        <li class="mb-0 d-flex align-items-start">
                                            <span class="bg-primary rounded-circle p-2 me-3 d-flex align-items-center justify-content-center">
                                                <i class="fas fa-check text-white small"></i>
                                            </span>
                                            Build an effective society that uplifts students through education and spiritual knowledge
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="vision-card h-100 p-4 rounded-3 border-start border-4 border-success">
                                    <h4 class="h5 fw-semibold mb-3">Our Vision</h4>
                                    <div class="d-flex align-items-start mb-3">
                                        <span class="bg-success rounded-circle p-2 me-3 d-flex align-items-center justify-content-center">
                                            <i class="fas fa-eye text-white"></i>
                                        </span>
                                        <p class="mb-0">Bring together international and national expertise to enhance learning experiences</p>
                                    </div>
                                    <div class="d-flex align-items-start">
                                        <span class="bg-success rounded-circle p-2 me-3 d-flex align-items-center justify-content-center">
                                            <i class="fas fa-eye text-white"></i>
                                        </span>
                                        <p class="mb-0">Create a platform for holistic development of every student</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- What We Offer -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-5">
                        <h2 class="h3 fw-semibold mb-4 text-center text-primary">What We Offer</h2>
                        <p class="text-center mb-5">
                            Through our platform, students can discover organizations that match their interests, participate
                            in events, and develop leadership capabilities.
                        </p>
                        
                        <div class="row g-4">
                            @php
                                $offers = [
                                    ['title' => 'Student Organizations', 'desc' => 'Connect with academic, cultural, and special interest groups that align with your passions.', 'icon' => 'fas fa-user-friends'],
                                    ['title' => 'Leadership Development', 'desc' => 'Gain practical experience in event management, team leadership, and organizational skills.', 'icon' => 'fas fa-chart-line'],
                                    ['title' => 'Events & Activities', 'desc' => 'Participate in technical festivals, cultural events, workshops, and community service initiatives.', 'icon' => 'fas fa-calendar-alt'],
                                    ['title' => 'Student Representation', 'desc' => 'Serve as the voice of the student body to the administration and faculty.', 'icon' => 'fas fa-microphone']
                                ];
                            @endphp

                            @foreach($offers as $offer)
                                <div class="col-md-6">
                                    <div class="card h-100 shadow-sm border-0 hover-lift rounded-3">
                                        <div class="card-body p-4 text-center">
                                            <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle p-3 mb-3 mx-auto">
                                                <i class="{{ $offer['icon'] }} fa-2x text-primary"></i>
                                            </div>
                                            <h5 class="card-title fw-semibold">{{ $offer['title'] }}</h5>
                                            <p class="card-text text-muted">{{ $offer['desc'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
        .hero-section {
            position: relative;
            padding: 20px 20px;
            text-align: center;
            background: linear-gradient(rgba(0, 123, 255, 0.85), rgba(0, 123, 255, 0.85)), url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1800&q=80');
            background-size: cover;
            background-position: center;
            border-radius: 20px;
            color: #fff;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 700;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.4);
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .hero-section p {
            font-size: 1.4rem;
            max-width: 700px;
            margin: 0 auto 30px;
            color: #f8f9fa;
            font-weight: 300;
        }

        .hero-section .divider {
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, transparent, #fff, transparent);
            margin: 25px auto;
            border-radius: 2px;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            background: #fff;
        }

        .shape-1 {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation: float 8s ease-in-out infinite;
        }

        .shape-2 {
            width: 50px;
            height: 50px;
            top: 60%;
            right: 15%;
            animation: float 6s ease-in-out infinite;
        }

        .shape-3 {
            width: 30px;
            height: 30px;
            bottom: 20%;
            left: 20%;
            animation: float 10s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
            100% { transform: translateY(0) rotate(0deg); }
        }

        .hero-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid #fff;
            color: #fff;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .hero-btn:hover {
            background: #fff;
            color: #007bff;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }
            
            .hero-section p {
                font-size: 1.1rem;
            }
        }
    </style>
@endpush

@push('scripts')
<!-- Font Awesome for icons -->
<script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
@endpush
