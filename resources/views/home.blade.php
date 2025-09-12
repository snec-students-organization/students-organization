@extends('layouts.app')

@section('content')
<style>
    /* Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: 'Montserrat', sans-serif;
        overflow-x: hidden;
        background: #0a1929;
        color: #fff;
    }
    
    .hero-section {
    position: relative;
    width: 100%;
    min-height: 100vh; /* ✅ fills full screen height */
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #0a1929, #122e4d);
    overflow: hidden;
    padding: 0;
}

/* keeps text & circle responsive and centered */
.hero-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;         /* ✅ stretch full width */
    max-width: 1400px;   /* ✅ keeps layout centered on big screens */
    margin: 0 auto;
    padding: 0 40px;
}

/* make sure no horizontal scrollbars */
html, body {
    max-width: 100%;
    overflow-x: hidden;
}
.hero-container {
    position: relative;
    z-index: 2;
}




    
    .hero-content {
        flex: 1;
        max-width: 600px;
        padding: 40px;
    }
    
    .hero-image {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .circle-container {
        position: relative;
        width: 380px;
        height: 380px;
        animation: float 6s ease-in-out infinite;
    }
    
    .circle {
        position: absolute;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, #63ffd6, #00bcd4);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 0 50px rgba(99, 255, 214, 0.4);
    }
    
    .circle-inner {
        width: 92%;
        height: 92%;
        background: #0a1929;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }
    
    .circle-inner img {
        width: 70%;
        height: auto;
        object-fit: contain;
        filter: drop-shadow(0 0 15px rgba(99, 255, 214, 0.6));
    }
    
    .hero-badge {
        display: inline-block;
        background: rgba(99, 255, 214, 0.15);
        color: #63ffd6;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 20px;
        letter-spacing: 1px;
        animation: fadeIn 1s ease-out;
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 15px;
        background: linear-gradient(to right, #63ffd6, #00bcd4);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        animation: slideIn 1s ease-out;
    }
    
    .hero-subtitle {
        font-size: 1.8rem;
        font-weight: 600;
        color: #a3d9ff;
        margin-bottom: 25px;
        animation: slideIn 1.2s ease-out;
    }
    
    .hero-description {
        color: #cce5ff;
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 35px;
        animation: fadeIn 1.5s ease-out;
    }
    
    .hero-stats {
        display: flex;
        gap: 30px;
        margin-bottom: 40px;
        animation: fadeIn 1.8s ease-out;
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-number {
        font-size: 2.2rem;
        font-weight: 700;
        color: #63ffd6;
        line-height: 1;
        margin-bottom: 5px;
    }
    
    .stat-label {
        font-size: 0.9rem;
        color: #a3d9ff;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .hero-buttons {
        display: flex;
        gap: 15px;
        animation: fadeIn 2s ease-out;
    }
    
    .btn {
        padding: 14px 32px;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        cursor: pointer;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #63ffd6, #00bcd4);
        color: #0a1929;
        border: none;
        box-shadow: 0 5px 15px rgba(99, 255, 214, 0.4);
    }
    
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(99, 255, 214, 0.6);
    }
    
    .btn-secondary {
        background: transparent;
        color: #63ffd6;
        border: 2px solid #63ffd6;
        box-shadow: 0 5px 15px rgba(99, 255, 214, 0.2);
    }
    
    .btn-secondary:hover {
        background: rgba(99, 255, 214, 0.1);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(99, 255, 214, 0.3);
    }
    
    .floating-shapes {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 1;
    }
    
    .shape {
        position: absolute;
        background: linear-gradient(45deg, rgba(99, 255, 214, 0.1), rgba(0, 188, 212, 0.1));
        border-radius: 50%;
    }
    
    .shape-1 {
        width: 300px;
        height: 300px;
        top: -150px;
        right: -150px;
    }
    
    .shape-2 {
        width: 200px;
        height: 200px;
        bottom: 50px;
        left: 100px;
    }
    
    .shape-3 {
        width: 150px;
        height: 150px;
        top: 200px;
        left: -75px;
    }
    
    .shape-4 {
        width: 100px;
        height: 100px;
        bottom: 100px;
        right: 200px;
    }
    
    @keyframes float {
        0% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0); }
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes slideIn {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    /* Mobile Logo Styling */
    .mobile-logo {
        display: none;
        text-align: center;
        margin-bottom: 30px;
    }
    
    .mobile-logo-circle {
        width: 120px;
        height: 120px;
        background: linear-gradient(45deg, #63ffd6, #00bcd4);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto 20px;
        box-shadow: 0 0 30px rgba(99, 255, 214, 0.4);
    }
    
    .mobile-logo-inner {
        width: 90%;
        height: 90%;
        background: #0a1929;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .mobile-logo-inner img {
        width: 60%;
        height: auto;
        filter: drop-shadow(0 0 10px rgba(99, 255, 214, 0.6));
    }
    
    /* Stats Section */
    .stats-section {
        background: linear-gradient(135deg, #0a1929 0%, #122e4d 100%);
        padding: 80px 0;
    }
    
    .stats-number {
        font-size: 2.5rem;
        font-weight: bold;
        color: #63ffd6;
    }
    
    .stats-section p {
        color: #a3d9ff;
    }
    
    /* About Section */
    .about-section {
        background: #0a1929;
        padding: 80px 0;
    }
    
    .about-content {
        display: flex;
        align-items: center;
        gap: 50px;
    }
    
    .about-text {
        flex: 1;
    }
    
    .about-image {
        flex: 1;
        display: flex;
        justify-content: center;
    }
    
    .about-image img {
        max-width: 100%;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    
    .section-title {
        color: #0a1929;
        font-weight: 800;
        margin-bottom: 15px;
    }
    
    .section-subtitle {
        color: #0a1929;
        margin-bottom: 40px;
    }
    
    .section-padding {
        padding: 60px 0; /* Reduced from 80px */
    }
    
    /* Feature Cards */
    .feature-card {
        background: #0a1929;
        border: 1px solid rgba(99, 255, 214, 0.1);
        border-radius: 10px;
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        border-color: rgba(99, 255, 214, 0.3);
        box-shadow: 0 10px 25px rgba(99, 255, 214, 0.15);
    }
    
    .feature-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #63ffd6;
    }
    
    .feature-card h4 {
        color: #ffffffff;
        margin-bottom: 15px;
    }
    
    .feature-card p {
        color: #cce5ff;
    }
    
    .btn-outline-primary {
        color: #ffffffff;
        border-color: #ffffffff;
    }
    
    .btn-outline-primary:hover {
        background-color: rgba(99, 255, 214, 0.1);
        color: #63ffd6;
        border-color: #63ffd6;
    }
    
    /* Event Cards */
        .event-card .card-title {
    color: #212529; /* Bootstrap's default dark text color */
    font-weight: 700;
    font-size: 1.4rem;
    text-shadow: none; /* remove any glowing or shadow */
    border-bottom: none; /* remove underline if any */
    padding-bottom: 0;
    margin-bottom: 0.75rem;
    transition: none; /* disable animation */
}

/* Remove hover color change and effects */
.event-card:hover .card-title {
    color: #212529;
    text-shadow: none;
}

    
    /* Gallery Section */
    .gallery-section {
        padding: 60px 0; /* Reduced from 80px */
    }
    
    /* Testimonial Cards */
    .testimonial-card {
        background: rgba(10, 25, 41, 0.7);
        border: 1px solid rgba(99, 255, 214, 0.1);
        border-radius: 10px;
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .testimonial-card:hover {
        transform: translateY(-5px);
        border-color: rgba(99, 255, 214, 0.3);
        box-shadow: 0 10px 25px rgba(99, 255, 214, 0.15);
    }
    
    .testimonial-card h6 {
        color: #63ffd6;
    }
    
    .testimonial-card p {
        color: #cce5ff;
    }
    
    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, #0a1929 0%, #122e4d 100%);
        padding: 80px 0;
    }
    
    .cta-section h2 {
        color: #63ffd6;
    }
    
    .cta-section p {
        color: #a3d9ff;
    }
    
    /* Footer */
    footer {
        background: #0a1929;
        border-top: 1px solid rgba(99, 255, 214, 0.1);
    }
    
    footer h5 {
        color: #63ffd6;
    }
    
    footer a {
        color: #a3d9ff;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    footer a:hover {
        color: #63ffd6;
    }
    
    footer p, footer li {
        color: #cce5ff;
    }
    
    /* Responsive Design */
    @media (max-width: 992px) {
        .hero-container {
            flex-direction: column;
            text-align: center;
            gap: 40px;
        }
        
        .hero-content {
            max-width: 100%;
            padding: 20px;
        }
        
        .hero-title {
            font-size: 3rem;
        }
        
        .hero-stats {
            justify-content: center;
        }
        
        .hero-buttons {
            justify-content: center;
        }
        
        .circle-container {
            width: 320px;
            height: 320px;
        }
        
        .about-content {
            flex-direction: column;
            text-align: center;
        }
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
        }
        
        .circle-container {
            width: 280px;
            height: 280px;
        }
        
        .hero-stats {
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .hero-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .btn {
            width: 250px;
            justify-content: center;
        }
        
        /* Show mobile logo and hide desktop circle on small devices */
        .mobile-logo {
            display: block;
        }
        
        .circle-container {
            display: none;
        }
        
        .section-padding {
            padding: 50px 0;
        }
    }
    
    @media (max-width: 480px) {
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
        }
        
        .stat-number {
            font-size: 1.8rem;
        }
        
        .mobile-logo-circle {
            width: 100px;
            height: 100px;
        }
        
        .section-padding {
            padding: 40px 0;
        }
    }

.gallery-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.07);
    padding: 12px;
    margin-bottom: 12px;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: box-shadow 0.2s;
    min-height: 300px; /* Ensures uniform card height for consistent grid */
}

.gallery-card img {
    width: 100%;
    height: 170px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 8px;
}

.gallery-card h5 {
    color: #212529;
    font-weight: 600;
    margin: 0;
    font-size: 1.15rem;
    text-align: center;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 100%;
}

@media (max-width: 767.98px) {
    .gallery-card img {
        height: 120px;
    }
}


.notification-bar {
    white-space: nowrap;
}
.marquee {
    display: inline-block;
    padding-left: 100%;
    animation: marquee 15s linear infinite;
}
@keyframes marquee {
    0%   { transform: translateX(0); }
    100% { transform: translateX(-100%); }
}
html, body {
    max-width: 100%;
    overflow-x: hidden; /* ✅ Prevent horizontal scroll */
}



@media (max-width: 767.98px) {
    footer .container {
        padding-left: 15px;
        padding-right: 15px;
    }

    footer .row {
        flex-direction: column !important;
        text-align: center;
    }

    footer .col-lg-4,
    footer .col-lg-2,
    footer .col-md-4 {
        max-width: 100% !important;
        flex: 0 0 100% !important;
        margin-bottom: 20px;
    }

    footer h5 {
        font-size: 1.25rem;
        margin-bottom: 15px;
    }

    footer ul.list-unstyled {
        padding-left: 0;
        list-style: none;
    }

    footer ul.list-unstyled li {
        margin-bottom: 10px;
    }

    footer ul.list-unstyled li a {
        font-size: 1rem;
        display: inline-block;
        width: 100%;
        padding: 8px 0;
    }

    footer .d-flex.gap-3 {
        justify-content: center;
    }

    footer .d-flex.gap-3 a {
        font-size: 1.5rem;
        padding: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background-color: rgba(99, 255, 214, 0.1);
        transition: background-color 0.3s ease;
    }

    footer .d-flex.gap-3 a:hover {
        background-color: rgba(99, 255, 214, 0.3);
        color: #63ffd6;
        text-decoration: none;
    }

    footer p.mb-0 {
        font-size: 0.9rem;
        padding: 10px 0;
    }
}



@media (max-width: 767.98px) {
    #events .container-fluid {
        padding-left: 15px;
        padding-right: 15px;
    }

    #events .row {
        margin-left: 0;
        margin-right: 0;
    }

    #events .col-md-4 {
        max-width: 100% !important;
        flex: 0 0 100% !important;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        margin-bottom: 1.5rem;
    }

    #events .card.event-card {
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        border-radius: 10px;
    }

    #events .card-img-top {
        height: auto;
        max-height: 200px;
        object-fit: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        width: 100%;
    }

    #events .card-title {
        font-size: 1.25rem;
        font-weight: 600;
    }

    #events .card-text {
        font-size: 0.95rem;
    }

    #events .btn-primary {
        padding: 12px 24px;
        font-size: 1rem;
        width: 100%;
        max-width: 300px;
        margin: 1rem auto 0 auto;
        display: block;
        border-radius: 30px;
        text-align: center;
    }

    #events .text-center.mb-5 h2.section-title {
        font-size: 1.75rem;
    }

    #events .text-center.mb-5 p.section-subtitle {
        font-size: 1rem;
        margin-bottom: 1rem;
    }
}



@media (max-width: 767.98px) {
    #gallery .container-fluid {
        padding-left: 15px;
        padding-right: 15px;
    }

    #gallery .row.g-3 {
        margin-left: 0;
        margin-right: 0;
    }

    #gallery .col-md-3,
    #gallery .col-6 {
        max-width: 50% !important;
        flex: 0 0 50% !important;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        margin-bottom: 1.25rem;
    }

    #gallery .img-fluid.rounded {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 12px;
    }

    #gallery h5 {
        font-size: 1rem;
        margin-top: 0.5rem;
        color: #000;
        word-break: break-word;
        text-align: center;
    }

    #gallery .text-center.mt-4 .btn-primary {
        width: 100%;
        max-width: 300px;
        padding: 12px 24px;
        font-size: 1rem;
        border-radius: 30px;
        margin: 1rem auto 0 auto;
        display: block;
        text-align: center;
    }
}

@media (max-width: 480px) {
    #gallery .col-md-3,
    #gallery .col-6 {
        max-width: 100% !important;
        flex: 0 0 100% !important;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }
}


@media (max-width: 767.98px) {
    .cta-section .row {
        flex-direction: column;
        text-align: center;
        gap: 20px;
    }

    .cta-section .col-lg-8,
    .cta-section .col-lg-4 {
        max-width: 100%;
        flex: 0 0 100%;
    }

    .cta-section .col-lg-4.text-lg-end {
        text-align: center !important;
    }

    .cta-section .btn {
        width: 100%;
        max-width: 280px;
        margin: 0 auto;
        font-size: 1.1rem;
        padding: 14px 0;
        border-radius: 30px;
    }

    .cta-section .btn.btn-primary {
        margin-bottom: 10px;
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
            <h1 class="hero-title">SNEC STUDENTS ORGANIZATION</h1>
            <div class="hero-subtitle">Empowering Future Leaders</div>
            
            <!-- Paragraph visible only on large screens -->
            <p class="hero-description d-none d-lg-block">
                Join a vibrant community of innovators, thinkers, and creators. At SSO, we provide opportunities for growth, networking, and skill development to help you excel in your academic and professional journey.
            </p>
            
            <div class="hero-buttons">
                <a href="{{ route('register') }}" class="btn btn-primary">
    <i class="fas fa-user-plus"></i> Join Now
</a>
<a href="{{ route('calendar') }}" class="btn btn-secondary">
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

    <style>
        .notification-bar {
            height: 50px;
            border-radius: 8px;
            margin: 1rem 0;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 0, 0, 0.25) !important;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .notification-bar:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 0, 0, 0.35) !important;
        }
        
        .marquee-container {
            white-space: nowrap;
            position: relative;
        }
        
        .marquee {
            display: inline-block;
            padding-left: 100%; /* Start from right */
            animation: marquee 20s linear infinite;
        }
        
        .notification-item {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        
        @keyframes marquee {
            0%   { transform: translateX(0%); }
            100% { transform: translateX(-100%); }
        }
        
        .pulse-dot {
            width: 12px;
            height: 12px;
            background-color: #ff0000;
            border-radius: 50%;
            animation: pulse 1.5s infinite;
            box-shadow: 0 0 0 rgba(255, 0, 0, 0.4);
        }
        
        @keyframes pulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.7);
            }
            
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(255, 0, 0, 0);
            }
            
            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(255, 0, 0, 0);
            }
        }
        
        /* Add a subtle flash animation to the entire bar */
        .notification-bar {
            animation: subtleFlash 3s infinite;
        }
        
        @keyframes subtleFlash {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.9; }
        }


        /* Features section general styling */
#features {
    padding: 60px 20px;
}

#features .section-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 10px;
}

#features .section-subtitle {
    font-size: 1rem;
    color: #6c757d;
    margin-bottom: 30px;
}

#features .feature-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px;
    background: #0d1b2a; /* dark bg look */
    color: #fff;
}

#features .feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

#features .feature-icon {
    font-size: 2rem;
    color: #00bcd4;
    margin-bottom: 12px;
}

/* Card title & text */
#features .card-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 10px;
}

#features .card-text {
    font-size: 0.95rem;
    color: #dee2e6;
    margin-bottom: 15px;
    min-height: 60px; /* keeps cards consistent height */
}

/* Buttons */
#features .btn {
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

#features .btn:hover {
    background: #00bcd4;
    color: #fff;
}

/* Responsive styling */
@media (max-width: 991.98px) {
    #features {
        padding: 40px 15px;
    }
}

/* Mobile screens: 2 per row & compact */
@media (max-width: 575.98px) {
    #features {
        padding: 25px 10px;
    }

    #features .section-title {
        font-size: 1.4rem;
    }

    #features .section-subtitle {
        font-size: 0.9rem;
    }

    #features .feature-card {
        padding: 12px !important;
        margin-bottom: 12px;
    }

    #features .feature-icon {
        font-size: 1.5rem;
        margin-bottom: 8px;
    }

    #features .card-title {
        font-size: 1rem;
    }

    #features .card-text {
        font-size: 0.8rem;
        min-height: 50px;
    }

    #features .btn {
    display: block;
    width: 100%;
    font-size: 0.7rem;      /* smaller text */
    padding: 4px 8px;       /* less padding */
    margin-top: 6px;
    text-align: center;
    border-radius: 18px;    /* smaller rounded button */
    white-space: normal;
    word-break: break-word;
}


    #features .container-fluid {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    #features .row > div {
        padding-left: 6px;
        padding-right: 6px;
    }
}
    </style>
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
                    The SNEC Students Organization (SSO) is a dynamic platform dedicated to fostering student growth, leadership, and community engagement. We serve as the central hub for all student organizations, events, and activities at our institution.
                </p>
                <p class="mb-4" style="color: #cce5ff; line-height: 1.6;">
                    Our mission is to empower students by providing opportunities for skill development, networking, and collaborative projects. Through our platform, students can discover organizations that match their interests, participate in events, and develop leadership capabilities.
                </p>
                <p class="mb-4" style="color: #cce5ff; line-height: 1.6;">
                    Whether you're looking to join an existing organization, start a new one, or simply participate in campus events, SSO provides the tools and resources you need to make the most of your college experience.
                </p>
                
            </div>
            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Students collaborating">
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
            <div class="col-lg-4 col-md-6 col-6 mb-4">

                <div class="card feature-card h-100 border-0">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon"><i class="fas fa-calendar-check"></i></div>
                        <h4 class="card-title">Event Management</h4>
                        <p class="card-text"> check events with our comprehensive event calendar.</p>
                        <a href="/calendar" class="btn btn-outline-primary">Explore Events</a>
                    </div>
                </div>
            </div>
           <div class="col-lg-4 col-md-6 col-6 mb-4">

                <div class="card feature-card h-100 border-0">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon"><i class="fas fa-users"></i></div>
                        <h4 class="card-title">Organization Directory</h4>
                        <p class="card-text">Discover and connect with various organizations in your community.</p>
                        <a href="/organizations" class="btn btn-outline-primary">Organizations</a>
                    </div>
                </div>
            </div>
           <div class="col-lg-4 col-md-6 col-6 mb-4">

                <div class="card feature-card h-100 border-0">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon"><i class="fas fa-camera"></i></div>
                        <h4 class="card-title">Event Gallery</h4>
                        <p class="card-text">Relive your favorite moments through our extensive event photo galleries.</p>
                        <a href="/gallery" class="btn btn-outline-primary">Visit Gallery</a>
                    </div>
                </div>
            </div>
           <div class="col-lg-4 col-md-6 col-6 mb-4">

                <div class="card feature-card h-100 border-0">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon"><i class="fas fa-bell"></i></div>
                        <h4 class="card-title">Notifications</h4>
                        <p class="card-text">Stay updated with notifications for events and organizations you follow.</p>
                        <a href="/notifications" class="btn btn-outline-primary"> Notifications</a>
                    </div>
                </div>
            </div>
          <div class="col-lg-4 col-md-6 col-6 mb-4">

                <div class="card feature-card h-100 border-0">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon"><i class="fas fa-user-friends"></i></div>
                        <h4 class="card-title">Committee Management</h4>
                        <p class="card-text">Efficiently manage committee members and their responsibilities.</p>
                        <a href="/committees" class="btn btn-outline-primary">Committees</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-4">

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
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
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