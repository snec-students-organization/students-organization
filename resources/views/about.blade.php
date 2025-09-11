@extends('layouts.app')

@section('content')

<section class="about-section container py-5"> <div class="row"> <div class="col-lg-8 mx-auto"> <h1 class="text-center mb-4">About SSO</h1>
        <div class="mb-5">
            <h2 class="h3 mb-3">Who We Are</h2>
            <p class="lead">
                The SNEC Students Organization (SSO) is the official, student-run governing body that serves as the dynamic platform dedicated to fostering holistic student development, leadership, and community engagement at Sinhgad National Educational Complex.
            </p>
            <p>
                We serve as the central hub for all student organizations, events, and activities at our institution, working to embody the core vision of molding a generation of ideal scholars equipped with both secular and spiritual education.
            </p>
        </div>

        <div class="mb-5">
            <h2 class="h3 mb-3">Our Mission & Vision</h2>
            <p>
                Our mission is to empower students by providing opportunities for skill development, networking, and collaborative projects that align with SNEC's broader educational goals. We strive to:
            </p>
            <ul>
                <li>Create a community of professionals who uphold Islamic values and ideals in their academic and professional pursuits</li>
                <li>Develop a research-oriented approach to various educational systems and knowledge domains</li>
                <li>Build an effective society that promotes the upliftment of students through proper education and spiritual knowledge</li>
                <li>Bring together international and national expertise to enhance learning experiences</li>
            </ul>
        </div>

        <div class="mb-5">
            <h2 class="h3 mb-3">What We Offer</h2>
            <p>
                Through our platform, students can discover organizations that match their interests, participate in events, and develop leadership capabilities. SSO provides:
            </p>
            <div class="row mt-4">
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Student Organizations</h5>
                            <p class="card-text">Connect with various academic, cultural, and special interest groups that align with your passions.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Leadership Development</h5>
                            <p class="card-text">Gain practical experience in event management, team leadership, and organizational skills.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Events & Activities</h5>
                            <p class="card-text">Participate in technical festivals, cultural events, workshops, and community service initiatives.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Student Representation</h5>
                            <p class="card-text">Serve as the voice of the student body to the administration and faculty.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>
</section> 
@endsection
<style> .about-section { background-color: #f8f9fa; } .card { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.3s ease; } .card:hover { transform: translateY(-5px); } .lead { font-weight: 400; line-height: 1.6; } </style>

