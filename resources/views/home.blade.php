@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')

<style>
    @media (max-width: 576px) {
  .hero-buttons .btn {
    padding: 0.55rem 1rem;  /* slightly more vertical padding */
    font-size: 0.9rem;      /* readable but not too big */
  }
}
@media (min-width: 992px) {
  .hero-buttons .btn {
    padding: 10px 70px;  /* reduced vertical padding */
    font-size: 0.9rem;   /* slightly smaller text */
  }
}


</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
    </div>
    
    <div class="hero-container">
        <div class="hero-content">
            <!-- Mobile & Medium Logo (visible on small & medium devices, hidden on large) -->     
            <div class="mobile-logo d-block d-lg-none text-center mb-3">
                <div class="mobile-logo-circle">
                    <div class="mobile-logo-inner">
                        <img src="/images/SSO.png" alt="SSO Logo">
                    </div>
                </div>
            </div>
            
            <div class="hero-badge">
                <i class="fas fa-rocket"></i> WELCOME TO SSO
            </div>
            <h1 class="hero-title">SNEC STUDENTS' ORGANIZATION</h1>
            <div class="hero-subtitle">Empowering Future Leaders</div>
            
            <!-- Paragraph visible only on large screens -->
            <p class="hero-description d-none d-lg-block">
                Join a vibrant community of innovators, thinkers, and creators. At SSO, we provide opportunities for growth, networking, and skill development to help you excel in your academic and professional journey.
            </p>
            
            <div class="hero-buttons">
    <a href="{{ route('register') }}" class="btn btn-primary btn-sm d-block d-sm-inline-block">
        <i class="fas fa-user-plus"></i> Join Now
    </a>
    <a href="{{ route('calendar') }}" class="btn btn-secondary btn-sm d-block d-sm-inline-block mt-2 mt-sm-0 ms-sm-2">
        <i class="fas fa-calendar-alt"></i> Upcoming Events
    </a>
</div>

        </div>
        
        <div class="hero-image">
            <!-- Desktop Circle (only visible on lg and up) -->
            <div class="circle-container d-none d-lg-block">
                <div class="circle">
                    <div class="circle-inner">
                        <img src="/images/SSO.png" alt="SSO Logo">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@if(isset($notifications) && $notifications->count())
    <a href="{{ route('notifications.index') }}" class="text-decoration-none">
        <div class="notification-bar bg-warning position-relative d-flex align-items-center shadow-lg" style="background: linear-gradient(135deg, #ff6b6b, #ff8e53) !important;">
            <!-- Fixed Label with Icon -->
            <div class="px-3 fw-bold d-flex align-items-center" style="background: rgba(0,0,0,0.2); min-width: 140px; height: 100%;">
                <span class="fs-5 me-2">🔔</span>
                <span class="text-white">ALERTS</span>
            </div>

            <!-- Scrolling Notifications -->
            <div class="marquee-container flex-grow-1 overflow-hidden position-relative">
                <div class="marquee d-inline-block py-2">
                    @foreach($notifications as $notification)
                        <span class="notification-item text-white fw-bold fs-6 px-3">
                            🚨 <strong>{{ $notification->title }}</strong> - {{ $notification->message }}
                            &nbsp;&nbsp;&nbsp; • &nbsp;&nbsp;&nbsp;
                        </span>
                    @endforeach
                </div>
                
                <!-- Pulsing indicator -->
                <div class="position-absolute top-0 end-0 h-100 d-flex align-items-center px-2" style="background: linear-gradient(90deg, transparent 0%, rgba(255,0,0,0.3) 100%);">
                    <span class="pulse-dot"></span>
                    <span class="text-white small ms-1">NEW</span>
                </div>
            </div>
        </div>
    </a>

    
@endif





<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-6 mb-4 mb-md-0">
                <div class="stats-number" id="org-count">50+</div>
                <p>Organizations</p>
            </div>
            <div class="col-md-3 col-6 mb-4 mb-md-0">
                <div class="stats-number" id="event-count">200+</div>
                <p>Events</p>
            </div>
            <div class="col-md-3 col-6">
                <div class="stats-number" id="member-count">1000+</div>
                <p>Members</p>
            </div>
            <div class="col-md-3 col-6">
                <div class="stats-number" id="gallery-count">500+</div>
                <p>Gallery Photos</p>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="about-section">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <h2 class="section-title" style="color: rgba(255, 255, 255, 1);">About SSO</h2>

                <p class="mb-4" style="color: #cce5ff; line-height: 1.6;">
                    The SNEC Students' Organization (SSO) is a dynamic platform dedicated to fostering students growth, leadership, and community engagement. We serve as the central hub for all student organizations, events, and activities at our institution.
                </p>
                <p class="mb-4" style="color: #cce5ff; line-height: 1.6;">
                    Our mission is to empower students by providing opportunities for skill development, networking, and collaborative projects. Through our platform, students can discover organizations that match their interests, participate in events, and develop leadership capabilities.
                </p>
                <p class="mb-4" style="color: #cce5ff; line-height: 1.6;">
                    Whether you're looking to join an existing organization, start a new one, or simply participate in campus events, SSO provides the tools and resources you need to make the most of your college experience.
                </p>
            </div>

            <!-- Bootstrap Carousel -->
            <div class="about-image">
                <div id="aboutCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/images/logolaunching.jpg" class="d-block w-100" alt="SSO Launching">
                        </div>
                        <div class="carousel-item">
                            <img src="/images/event1.jpg" class="d-block w-100" alt="Event 1">
                        </div>
                        <div class="carousel-item">
                            <img src="/images/event2.jpg" class="d-block w-100" alt="Event 2">
                        </div>
                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#aboutCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#aboutCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Features Section -->
<section id="features" class="section-padding">
    <div class="container-fluid">
        <div class="text-center mb-5">
            <h2 class="section-title">Powerful Features</h2>
            <p class="section-subtitle">Everything you need to manage your organizations and events</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6  mb-4">

                <div class="card feature-card h-100 border-0">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon"><i class="fas fa-calendar-check"></i></div>
                        <h4 class="card-title">Event Management</h4>
                        <p class="card-text"> check events with our comprehensive event calendar.</p>
                        <a href="/calendar" class="btn btn-outline-primary">Explore Events</a>
                    </div>
                </div>
            </div>
           <div class="col-lg-4 col-md-6  mb-4">

                <div class="card feature-card h-100 border-0">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon"><i class="fas fa-users"></i></div>
                        <h4 class="card-title">Organization Directory</h4>
                        <p class="card-text">Discover and connect with various organizations in your community.</p>
                        <a href="/organizations" class="btn btn-outline-primary">Organizations</a>
                    </div>
                </div>
            </div>
           <div class="col-lg-4 col-md-6  mb-4">

                <div class="card feature-card h-100 border-0">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon"><i class="fas fa-camera"></i></div>
                        <h4 class="card-title">Event Gallery</h4>
                        <p class="card-text">Relive your favorite moments through our extensive event photo galleries.</p>
                        <a href="/gallery" class="btn btn-outline-primary">Visit Gallery</a>
                    </div>
                </div>
            </div>
           <div class="col-lg-4 col-md-6  mb-4">

                <div class="card feature-card h-100 border-0">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon"><i class="fas fa-bell"></i></div>
                        <h4 class="card-title">Notifications</h4>
                        <p class="card-text">Stay updated with notifications for events and organizations you follow.</p>
                        <a href="/notifications" class="btn btn-outline-primary"> Notifications</a>
                    </div>
                </div>
            </div>
          <div class="col-lg-4 col-md-6  mb-4">

                <div class="card feature-card h-100 border-0">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon"><i class="fas fa-user-friends"></i></div>
                        <h4 class="card-title">Committee Management</h4>
                        <p class="card-text">Efficiently manage committee members and their responsibilities.</p>
                        <a href="/committees" class="btn btn-outline-primary">Committees</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6  mb-4">

                <div class="card feature-card h-100 border-0">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon"><i class="fas fa-user-shield"></i></div>
                        <h4 class="card-title">College Dashboard</h4>
                        <p class="card-text">Powerful tools for institutions to manage their students.</p>
                        <a href="/institution/login" class="btn btn-outline-primary">College Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Upcoming Events Section -->
<section id="events" class="section-padding">
    <div class="container-fluid">
        <div class="text-center mb-5">
            <h2 class="section-title">Upcoming Events</h2>
            <p class="section-subtitle">Don't miss these exciting upcoming events</p>
        </div>
        <div class="row" id="upcoming-events">
            @if($upcomingEvents->isEmpty())
                <div class="col-12 text-center">
                    <p>No upcoming events available at the moment.</p>
                </div>
            @else
                @foreach($upcomingEvents as $event)
                    <div class="col-md-4 mb-4">
                        <div class="card event-card h-100">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->title }}">
                            @else
                                <img src="https://via.placeholder.com/600x300?text=No+Image" class="card-img-top" alt="{{ $event->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <p class="card-text">
                                    <i class="far fa-calendar me-2"></i>
                                    {{ optional($event->event_date)->format('F j, Y') ?? '-' }}
                                </p>
                                <p class="card-text"><i class="fas fa-map-marker-alt me-2"></i>{{ $event->location }}</p>
                                @if($event->description)
                                    <p class="card-text">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="text-center mt-4">
            <a href="{{ url('/calendar') }}" class="btn btn-primary">View All Events</a>
        </div>
    </div>
</section>


<!-- Gallery Preview Section -->
<section id="gallery" class="gallery-section">
    <div class="container-fluid">
        <div class="text-center mb-5">
            <h2 class="section-title">Event Gallery</h2>
            <p class="section-subtitle">Highlights from our recent events</p>
        </div>

        <div class="row g-3" id="gallery-preview">
            @if($markedGalleryEvents->isEmpty())
                <div class="col-12 text-center">
                    <p>No marked events available at the moment.</p>
                </div>
            @else
                @foreach($markedGalleryEvents as $event)
                    <div class="col-md-3 col-6">
                        @if($event->cover_image)
                            <img src="{{ asset('storage/' . $event->cover_image) }}"
                                class="img-fluid rounded"
                                alt="{{ $event->name }}">
                        @else
                            <img src="https://via.placeholder.com/600x400?text=No+Image"
                                class="img-fluid rounded"
                                alt="No image available">
                        @endif
                        <h5 class="mt-2 text-center" style="color: #000000ff;">{{ $event->name }}</h5>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="text-center mt-4">
            <a href="{{ url('/gallery') }}" class="btn btn-primary">View Full Gallery</a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->


<!-- CTA Section -->
<section class="cta-section section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h2 class="fw-bold">Ready to Get Started?</h2>
                <p class="lead mb-0">Join our community today and start exploring organizations and events</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="/register" class="btn btn-primary btn-lg me-2">Sign Up Now</a>
                <a href="/login" class="btn btn-secondary btn-lg">Login</a>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h5 class="fw-bold mb-4">SNEC STUDENTS’ ORGANIZATION (SS0)
</h5>
                <p>A comprehensive platform for managing organizations, events, and community engagement.</p>
                <div class="d-flex gap-3">
                    <a href="https://www.facebook.com/profile.php?id=61550072942049&mibextid=ZbWKwL
"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://youtube.com/@snecstudents?si=dVkZFhICOXF8Ct-L
"><i class="fab fa-youtube"></i></a>
                    <a href="https://instagram.com/snecstudents?utm_source=qr&igshid=MzNlNGNkZWQ4Mg%3D%3D
"><i class="fab fa-instagram"></i></a>
                    <a href="https://whatsapp.com/channel/0029VazpkGv5a24D8kBK8y2Z
"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                <h5 class="fw-bold mb-4">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#features">Features</a></li>
                    <li class="mb-2"><a href="/organizations">Organizations</a></li>
                    <li class="mb-2"><a href="/calendar">Events</a></li>
                    <li class="mb-2"><a href="/gallery">Gallery</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                <h5 class="fw-bold mb-4">Account</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="/login">Login</a></li>
                    <li class="mb-2"><a href="/register">Register</a></li>
                    <li class="mb-2"><a href="/user/dashboard">Dashboard</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4">
                <h5 class="fw-bold mb-4">Contact Us</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-envelope me-2"></i> ssocentralcommittee@gmail.com
</li>
                    <li class="mb-2"><i class="fas fa-phone me-2"></i> +91 9061347325</li>
                    <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> SAMASTHA National Education Council (SNEC)
Central Office, SAMASTHA Karyalayam, Francis Road, Kozhikode-03
</li>
                </ul>
            </div>
        </div>
        <hr class="my-4" style="border-color: rgba(99, 255, 214, 0.2);">
        <div class="text-center">
            <p class="mb-0">&copy; 2025 SNEC STUDENTS’ ORGANIZATION . All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->

<script>
    // Simple animation for stats counter
    function animateValue(id, start, end, duration) {
        let obj = document.getElementById(id);
        let range = end - start;
        let increment = end > start ? 1 : -1;
        let stepTime = Math.abs(Math.floor(duration / range));
        let timer = setInterval(function() {
            start += increment;
            obj.textContent = start + '+';
            if (start == end) {
                clearInterval(timer);
            }
        }, stepTime);
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        animateValue('org-count', 0, 50, 2000);
        animateValue('event-count', 0, 200, 2000);
        animateValue('member-count', 0, 1000, 2000);
        animateValue('gallery-count', 0, 500, 2000);
    });
</script>
    

@endsection