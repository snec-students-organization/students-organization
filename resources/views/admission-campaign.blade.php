@extends('layouts.app')

@section('styles')
    <style>
        .campaign-hero {
            background: linear-gradient(135deg, #0a1929 0%, #122e4d 100%);
            padding: 100px 0;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .campaign-hero::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/images/ok.jpg.jpeg') center/50% no-repeat;
            opacity: 0.1;
            z-index: 0;
        }

        .campaign-content {
            position: relative;
            z-index: 1;
        }

        .campaign-header {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            background: linear-gradient(to right, #63ffd6, #00bcd4);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .highlight-text {
            color: #63ffd6;
            font-weight: 700;
        }

        .card-custom {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(99, 255, 214, 0.2);
            border-radius: 15px;
            padding: 30px;
            height: 100%;
            transition: transform 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-10px);
            border-color: #63ffd6;
        }

        .icon-circle {
            width: 60px;
            height: 60px;
            background: rgba(99, 255, 214, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: #63ffd6;
            font-size: 1.5rem;
        }

        .section-padding {
            padding: 80px 0;
        }

        .apply-btn {
            background: linear-gradient(45deg, #63ffd6, #00bcd4);
            color: #0a1929;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(99, 255, 214, 0.4);
        }

        .apply-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(99, 255, 214, 0.6);
            color: #0a1929;
        }
    </style>
@endsection

@section('content')
    <section class="campaign-hero">
        <div class="container campaign-content text-center">
            <h1 class="campaign-header">SNEC Admission Campaign 2026</h1>
            <p class="lead mb-5">Empowering the next generation of scholars with holistic education and leadership skills.
            </p>
            <a href="https://www.snec.in/admission" target="_blank" class="apply-btn">Register Now</a>
        </div>
    </section>

    <section class="section-padding" style="background: #0a1929; color: white;">
        <div class="container text-center">
            <h2 class="display-5 fw-bold mb-4">Know more about <span class="highlight-text">SNEC</span></h2>
            <p class="lead mb-5 text-muted">Samastha National Education Council (SNEC) is a premier educational body
                committed to fostering knowledge, character, and leadership.</p>
            <a href="https://www.snec.in" target="_blank" class="modern-btn primary"
                style="padding: 18px 45px; font-size: 1.1rem;">
                <span>Visit Official Website</span>
                <i class="fas fa-external-link-alt ml-2"></i>
            </a>
        </div>
    </section>

    <!-- Admission Data Collection Form Section -->
    <section class="section-padding" style="background: #122e4d; color: white;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="glass-card p-5" data-aos="fade-up">
                        <h2 class="modern-title text-center mb-5" style="font-size: 2.5rem;">Admission <span
                                class="gradient-text">Data Collection</span></h2>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert"
                                style="border-radius: 15px; background: rgba(40, 167, 69, 0.2); border: 1px solid rgba(40, 167, 69, 0.3); color: #fff;">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('admission.submit') }}" method="POST" class="modern-form">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group mb-3 text-start">
                                        <label class="form-label small text-uppercase fw-bold text-light-blue">Student
                                            Name</label>
                                        <input type="text" name="student_name" class="form-control modern-input"
                                            placeholder="Enter Full Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3 text-start">
                                        <label class="form-label small text-uppercase fw-bold text-light-blue">UID
                                            NO</label>
                                        <input type="text" name="uid_no" class="form-control modern-input"
                                            placeholder="Enter UID Number" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3 text-start">
                                        <label class="form-label small text-uppercase fw-bold text-light-blue">College
                                            Name</label>
                                        <input type="text" name="college_name" class="form-control modern-input"
                                            placeholder="Enter Full College Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3 text-start">
                                        <label class="form-label small text-uppercase fw-bold text-light-blue">Contact
                                            Number</label>
                                        <input type="text" name="contact_number" class="form-control modern-input"
                                            placeholder="Enter Phone Number" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3 text-start">
                                        <label class="form-label small text-uppercase fw-bold text-light-blue">Application
                                            Number of New Student</label>
                                        <input type="text" name="application_number" class="form-control modern-input"
                                            placeholder="Enter Application Number" required>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="modern-btn primary w-100 justify-content-center">
                                        <span>Submit Information</span>
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .modern-input {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 12px !important;
            color: #fff !important;
            padding: 12px 20px !important;
            transition: all 0.3s ease !important;
        }

        .modern-input:focus {
            background: rgba(255, 255, 255, 0.08) !important;
            border-color: #63ffd6 !important;
            box-shadow: 0 0 15px rgba(99, 255, 214, 0.2) !important;
            outline: none !important;
        }

        .modern-input::placeholder {
            color: rgba(255, 255, 255, 0.3) !important;
        }

        .text-light-blue {
            color: #a3d9ff;
        }

        .modern-form .form-label {
            margin-bottom: 8px;
            display: block;
            letter-spacing: 0.5px;
        }
    </style>


    <section class="section-padding bg-light">
        <div class="container text-center">
            <h2 class="mb-4">Ready to unlock your potential?</h2>
            <p class="mb-5 text-dark">Contact our helpdesk for more information about courses, institutions, and admission
                procedures.</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="mailto:ssocentralcommittee@gmail.com" class="btn btn-outline-dark btn-lg">Email Us</a>
                <a href="tel:+919061347325" class="btn btn-dark btn-lg">Call Support</a>
            </div>
        </div>
    </section>

    @if(session('scratch_card_amount') && session('admission_id'))
        <!-- Scratch Card Modal -->
        <div class="modal fade" id="scratchCardModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="scratchCardModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content"
                    style="background: #122e4d; color: white; border-radius: 20px; border: 2px solid #63ffd6; overflow: hidden; box-shadow: 0 10px 30px rgba(99, 255, 214, 0.4);">
                    <div class="modal-header border-0 pb-0 justify-content-center pt-4">
                        <h5 class="modal-title fw-bold text-center w-100" id="scratchCardModalLabel" style="font-size: 1.8rem;">
                            <span class="gradient-text">Congratulations!</span>
                        </h5>
                    </div>
                    <div class="modal-body text-center pt-2 pb-4 px-4">
                        <p class="mb-4" style="color: #a3d9ff;">You've earned a scratch card for submitting your admission!</p>

                        <div class="scratch-card-container position-relative mx-auto mb-4"
                            style="width: 250px; height: 150px; border-radius: 15px; overflow: hidden; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); display: flex; align-items: center; justify-content: center; box-shadow: inset 0 0 10px rgba(0,0,0,0.5);">

                            <!-- Reward Content (Hidden under canvas) -->
                            <div id="rewardContent"
                                class="text-center w-100 h-100 d-flex flex-column align-items-center justify-content-center"
                                style="opacity: 0;">
                                <span class="fw-bold" style="font-size: 1.2rem; color: #fff;">You Won</span>
                                <span class="fw-bold"
                                    style="font-size: 2.5rem; color: #fff; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">₹{{ session('scratch_card_amount') }}</span>
                            </div>

                            <!-- Canvas for Scratching -->
                            <canvas id="scratchCanvas" width="250" height="150" class="position-absolute top-0 start-0"
                                style="cursor: pointer;"></canvas>
                        </div>

                        <!-- GPay Form (Hidden initially) -->
                        <div id="gpayFormContainer" style="display: none; transition: all 0.5s ease;">
                            <p class="mb-3 fw-bold" style="color: #63ffd6; font-size: 1.1rem;">Reward claimed successfully! Your application ID is being verified. Once confirmed, the reward amount will be transferred shortly.</p>
                            <form id="claimRewardForm">
                                @csrf
                                <input type="hidden" name="admission_id" value="{{ session('admission_id') }}">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"
                                        style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #fff;"><i
                                            class="fab fa-google-pay fs-4"></i></span>
                                    <input type="text" class="form-control modern-input m-0" name="gpay_number" id="gpay_number"
                                        placeholder="Enter GPay Number" required pattern="[0-9]{10}">
                                    <button class="btn btn-primary" type="submit" id="claimBtn"
                                        style="background: linear-gradient(45deg, #63ffd6, #00bcd4); color: #0a1929; border: none; font-weight: bold;">Claim
                                        >></button>
                                </div>
                            </form>
                        </div>

                        <div id="claimSuccessMsg" class="alert alert-success mt-3" style="display: none; border-radius: 15px;">
                            <i class="fas fa-check-circle me-2"></i> Reward claimed successfully! Your application ID is being verified. Once confirmed, the reward amount will be transferred shortly.
                        </div>
                    </div>
                    <div class="modal-footer border-0 justify-content-center pb-4 pt-0">
                        <button type="button" class="btn btn-outline-light rounded-pill px-4"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confetti Library -->
        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var scratchModal = new bootstrap.Modal(document.getElementById('scratchCardModal'));
                scratchModal.show();

                const canvas = document.getElementById('scratchCanvas');
                const ctx = canvas.getContext('2d');
                const rewardContent = document.getElementById('rewardContent');
                const gpayFormContainer = document.getElementById('gpayFormContainer');

                let isDrawing = false;
                let scratchedPixels = 0;
                let totalPixels = 0;
                let isRevealed = false;

                // Setup Canvas
                function initCanvas() {
                    ctx.fillStyle = '#C0C0C0'; // Silver color for scratch layer
                    ctx.fillRect(0, 0, canvas.width, canvas.height);

                    // Add texture/text to scratch layer
                    ctx.fillStyle = '#808080';
                    ctx.font = '20px Arial';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillText('SCRATCH HERE', canvas.width / 2, canvas.height / 2);

                    totalPixels = canvas.width * canvas.height;
                    ctx.globalCompositeOperation = 'destination-out';
                }

                initCanvas();

                function getMousePos(canvas, evt) {
                    var rect = canvas.getBoundingClientRect();
                    return {
                        x: (evt.clientX || evt.touches[0].clientX) - rect.left,
                        y: (evt.clientY || evt.touches[0].clientY) - rect.top
                    };
                }

                function scratch(x, y) {
                    ctx.beginPath();
                    ctx.arc(x, y, 20, 0, Math.PI * 2, false);
                    ctx.fill();
                    checkScratchedOut();
                }

                function startDraw(e) {
                    isDrawing = true;
                    const pos = getMousePos(canvas, e);
                    scratch(pos.x, pos.y);
                    e.preventDefault();
                }

                function draw(e) {
                    if (!isDrawing) return;
                    const pos = getMousePos(canvas, e);
                    scratch(pos.x, pos.y);
                    e.preventDefault();
                }

                function endDraw() {
                    isDrawing = false;
                }

                canvas.addEventListener('mousedown', startDraw);
                canvas.addEventListener('mousemove', draw);
                canvas.addEventListener('mouseup', endDraw);
                canvas.addEventListener('mouseleave', endDraw);

                canvas.addEventListener('touchstart', startDraw);
                canvas.addEventListener('touchmove', draw);
                canvas.addEventListener('touchend', endDraw);

                function checkScratchedOut() {
                    if (isRevealed) return;

                    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                    let clearPixels = 0;

                    // Check every 4th byte (alpha channel) to see how much is transparent
                    for (let i = 3; i < imageData.data.length; i += 4) {
                        if (imageData.data[i] === 0) {
                            clearPixels++;
                        }
                    }

                    const percent = (clearPixels / totalPixels) * 100;

                    // If more than 50% scratched, reveal!
                    if (percent > 40) {
                        isRevealed = true;
                        // Fade out canvas
                        canvas.style.transition = 'opacity 0.5s ease-out';
                        canvas.style.opacity = '0';

                        // Show reward content
                        rewardContent.style.transition = 'opacity 0.5s ease-in';
                        rewardContent.style.opacity = '1';

                        // Show GPay form
                        setTimeout(() => {
                            canvas.style.display = 'none';
                            gpayFormContainer.style.display = 'block';

                            // Fire Confetti!
                            confetti({
                                particleCount: 100,
                                spread: 70,
                                origin: { y: 0.6 },
                                colors: ['#63ffd6', '#00bcd4', '#ffffff']
                            });
                        }, 500);
                    }
                }

                // Handle AJAX form submission
                $('#claimRewardForm').on('submit', function (e) {
                    e.preventDefault();
                    const btn = $('#claimBtn');
                    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

                    $.ajax({
                        url: '{{ route("admission.claimScratchCard") }}',
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function (response) {
                            if (response.success) {
                                $('#gpayFormContainer').fadeOut(() => {
                                    $('#claimSuccessMsg').fadeIn();
                                });
                                // Optional: disable close button for a moment, or auto close
                            }
                        },
                        error: function (xhr) {
                            alert('Something went wrong. Please try again.');
                            btn.prop('disabled', false).html('Claim >>');
                        }
                    });
                });
            });
        </script>
    @endif
@endsection