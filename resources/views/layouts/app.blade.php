<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>SSO - SNEC Students Organization</title>

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


    <style>
        :root {
            --primary-color: #00bcd4;
            --secondary-color: #6c757d;
            --success-color: #00bcd4;
            --dark-primary: #0a58ca;
            --light-primary: #e8f4ff;
            --navbar-height: 70px;
            --transition-speed: 0.3s;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: var(--navbar-height);
            min-height: 100vh;
        }

        .navbar {
            height: var(--navbar-height);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            transition: all var(--transition-speed) ease;
        }

        .navbar.scrolled {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .navbar-brand {
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            transition: all var(--transition-speed) ease;
            position: relative;
        }

        .navbar-brand::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 3px;
            background: var(--primary-color);
            border-radius: 2px;
            transition: width var(--transition-speed) ease;
        }

        .navbar-brand:hover::after {
            width: 100%;
        }

        .navbar-brand i {
            font-size: 1.8rem;
            transition: all var(--transition-speed) ease;
        }

        .navbar-brand:hover i {
            transform: scale(1.1) rotate(5deg);
        }

        .nav-link {
            font-weight: 500;
            border-radius: 0.5rem;
            margin: 0 0.15rem;
            padding: 0.5rem 0.9rem !important;
            transition: all 0.25s ease;
            position: relative;
            display: flex;
            align-items: center;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: all var(--transition-speed) ease;
            transform: translateX(-50%);
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: var(--light-primary);
            transform: translateY(-2px);
        }

        .nav-link:hover::before,
        .nav-link.active::before {
            width: 70%;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-radius: 0.75rem;
            padding: 0.5rem;
            margin-top: 0.75rem;
            animation: dropdownFade 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        @keyframes dropdownFade {
            from {
                opacity: 0;
                transform: translateY(-10px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .dropdown-item {
            border-radius: 0.5rem;
            padding: 0.6rem 1rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .dropdown-item:hover {
            background-color: var(--light-primary);
            padding-left: 1.25rem;
        }

        .dropdown-divider {
            margin: 0.4rem 0;
        }

        .dropdown-header {
            font-weight: 600;
            color: var(--dark-primary);
            padding: 0.5rem 1rem;
        }

        .badge-notification {
            position: absolute;
            top: -5px;
            right: -5px;
            font-size: 0.65rem;
            padding: 0.2rem 0.45rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            from {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
            }
            70% {
                box-shadow: 0 0 0 6px rgba(220, 53, 69, 0);
            }
            to {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
            }
        }

        .notification-indicator {
            position: relative;
            padding: 0.5rem;
            border-radius: 50%;
            transition: all var(--transition-speed) ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-indicator:hover {
            background-color: var(--light-primary);
            transform: translateY(-2px);
        }

        .navbar-toggler {
            border: none;
            padding: 0.5rem;
            transition: all var(--transition-speed) ease;
            border-radius: 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px var(--light-primary);
        }

        .navbar-toggler:hover {
            background-color: var(--light-primary);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--dark-primary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 0.5rem;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .nav-link:hover .user-avatar {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .notification-item-wrapper {
            padding: 0.75rem;
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .notification-item-wrapper.unread {
            background-color: rgba(13, 110, 253, 0.05);
            border-left-color: var(--primary-color);
        }

        .notification-item-wrapper:hover {
            background-color: rgba(13, 110, 253, 0.08);
        }

        .notification-item-content {
            display: flex;
            align-items: flex-start;
        }

        .notification-icon {
            font-size: 1.2rem;
            margin-right: 0.75rem;
            color: var(--secondary-color);
        }

        .notification-details {
            flex: 1;
        }

        .notification-text a {
            color: #212529;
            text-decoration: none;
        }

        .notification-text a:hover {
            color: var(--primary-color);
        }

        .notification-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.25rem;
            font-size: 0.8rem;
            color: var(--secondary-color);
        }

        .notification-actions-compact {
            display: flex;
            gap: 0.25rem;
        }

        .btn-notification-compact {
            padding: 0.15rem 0.35rem;
            font-size: 0.75rem;
        }

        .empty-notifications {
            padding: 1.5rem 1rem;
            text-align: center;
            color: var(--secondary-color);
        }

        .empty-notifications i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            opacity: 0.5;
        }

        .dropdown-menu-notifications {
            width: 350px;
            max-height: 400px;
            overflow-y: auto;
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: white;
                padding: 1rem;
                border-radius: 0.75rem;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
                margin-top: 0.75rem;
                backdrop-filter: blur(10px);
                background: rgba(255, 255, 255, 0.98);
            }
            .nav-link {
                margin: 0.25rem 0;
                padding: 0.75rem 1rem !important;
            }
            .dropdown-menu {
                box-shadow: none;
                border: 1px solid rgba(0, 0, 0, 0.08);
                margin: 0.5rem 0;
            }
            .navbar-toggler {
                padding: 0.5rem 0.75rem;
            }
            .dropdown-menu-notifications {
                width: 100%;
            }
        }
        
        .dropdown-menu::-webkit-scrollbar {
            width: 6px;
        }
        .dropdown-menu::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
            margin: 5px 0;
        }
        .dropdown-menu::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        .dropdown-menu::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        
        main {
            min-height: calc(100vh - var(--navbar-height) - 80px);
        }
        
        .logo-img {
            height: 40px;
            width: auto;
            margin-right: 10px;
        }
    </style>

    @yield('styles')
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold custom-green d-flex align-items-center" href="{{ url('/') }}">
    <img src="/images/SSO.png" alt="SSO Logo" class="logo-img">
    SSO
</a>


            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    @guest
    {{-- Show Home for guests (not logged in) --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
            <i class="bi bi-house me-2"></i> Home
        </a>
    </li>
     {{-- College Login Link --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->is('institution/login') ? 'active fw-bold' : '' }}" href="{{ route('institution.login') }}">
            <i class="bi bi-door-open me-2"></i> College Login
        </a>
    </li>
@else
    @if(Auth::user()->role === 'admin')
        {{-- Show Home for admins if needed --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                <i class="bi bi-house me-2"></i> Home
            </a>
        </li>
    @endif
@endguest

                    

                    <li class="nav-item">
                        <a
                            class="nav-link {{ request()->is('calendar') ? 'active fw-bold' : '' }}"
                            href="{{ route('calendar') }}">
                            <i class="bi bi-calendar-event me-2"></i> Calendar
                        </a>
                    </li>
                    <li class="nav-item">
    <a 
        class="nav-link {{ request()->is('about') ? 'active fw-bold' : '' }}" 
        href="{{ route('about') }}">
        <i class="bi bi-info-circle me-2"></i> About
    </a>
</li>
                    
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a
                                    class="nav-link {{ request()->is('admin*') && !request()->is('admin/upcoming-events*') && !request()->is('admin/committees*') && !request()->is('admin/gallery-events*') && !request()->is('admin/notifications*') ? 'active fw-bold' : '' }}"
                                    href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Admin Dashboard
                                </a>
                            </li>
                            <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    Admin Menu
  </a>
  <ul class="dropdown-menu" aria-labelledby="adminDropdown">
    <li>
      <a class="dropdown-item {{ request()->is('admin/upcoming-events*') ? 'active fw-bold' : '' }}" href="{{ route('admin.upcoming-events.index') }}">
        <i class="bi bi-calendar3-event me-2"></i> Upcoming Events
      </a>
    </li>
    <li>
      <a class="dropdown-item {{ request()->is('admin/committees*') ? 'active fw-bold' : '' }}" href="{{ route('admin.committees.index') }}">
        <i class="bi bi-people me-2"></i> Committees
      </a>
    </li>
    <li>
      <a class="dropdown-item {{ request()->is('admin/gallery-events*') ? 'active fw-bold' : '' }}" href="{{ route('admin.gallery-events.index') }}">
        <i class="bi bi-images me-2"></i> Gallery Events
      </a>
    </li>
    <li>
      <a class="dropdown-item {{ request()->is('admin/notifications*') ? 'active fw-bold' : '' }}" href="{{ route('admin.notifications.index') }}">
        <i class="bi bi-bell me-2"></i> Notifications
      </a>
    </li>

    <!-- Student Manage -->
    <li>
      <a class="dropdown-item {{ request()->is('admin/students*') ? 'active fw-bold' : '' }}" href="{{ route('admin.students.index') }}">
        <i class="bi bi-people-fill me-2"></i> Student Manage
      </a>
    </li>

    <!-- Payments -->
    <li>
      <a class="dropdown-item {{ request()->is('admin/payments*') ? 'active fw-bold' : '' }}" href="{{ route('admin.payments.index') }}">
        <i class="bi bi-wallet2 me-2"></i> Payments
      </a>
    </li>

    <!-- Payment Settings -->
    <li>
      <a class="dropdown-item {{ request()->is('admin/payment-settings*') ? 'active fw-bold' : '' }}" href="{{ route('admin.payment-settings.edit') }}">
        <i class="bi bi-gear me-2"></i> Payment Settings
      </a>
    </li>
    
    <!-- institutions-->
      <li>
      <a class="dropdown-item {{ request()->is('admin/institutions*') ? 'active fw-bold' : '' }}" href="{{ route('admin.institutions.index') }}">
        <i class="bi bi-gear me-2"></i> colleges
      </a>
    </li>
  

<li>
    <a class="dropdown-item {{ request()->is('organizations*') ? 'active fw-bold' : '' }}" href="{{ route('organizations.index') }}">
        <i class="bi bi-building me-2"></i> Organizations
    </a>
</li>
</ul>
</li>




                        @elseif(Auth::user()->role === 'user')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('user/dashboard') ? 'active fw-bold' : '' }}" href="{{ route('user.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="{{ route('notifications.index') }}" title="View Notifications">
                                <i class="bi bi-bell fs-5"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link {{ request()->is('login') ? 'active fw-bold' : '' }}"
                                href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Login
                            </a>
                        </li>
                        @if(Route::has('register'))
                            <li class="nav-item">
                                <a
                                    class="nav-link {{ request()->is('register') ? 'active fw-bold' : '' }}"
                                    href="{{ route('register') }}">
                                    <i class="bi bi-person-plus me-2"></i> Register
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown mx-1">
                            <a
                                class="nav-link notification-indicator position-relative"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                title="Notifications">
                                <i class="bi bi-bell fs-5"></i>
                                @if(!empty($recentNotifications) && $recentNotifications->where('read_at', null)->count() > 0)
                                    <span class="badge bg-danger rounded-pill badge-notification">
                                        {{ $recentNotifications->where('read_at', null)->count() }}
                                    </span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-notifications">
                                <li><h6 class="dropdown-header">Notifications</h6></li>
                                @forelse($recentNotifications ?? [] as $notification)
                                    <li class="notification-item-wrapper @if(!$notification->read_at) unread @endif">
                                        <div class="notification-item-content">
                                            <div class="notification-icon">
                                                <i class="bi
                                                    @if(isset($notification->type) && $notification->type === 'event') bi-calendar-event
                                                    @elseif(isset($notification->type) && $notification->type === 'alert') bi-exclamation-triangle
                                                    @elseif(isset($notification->type) && $notification->type === 'info') bi-info-circle
                                                    @else bi-bell
                                                    @endif
                                                "></i>
                                            </div>
                                            <div class="notification-details">
                                                <div class="notification-text">
                                                    <a
                                                        href="{{ (isset($notification->event) && $notification->event->id) ? route('events.show', $notification->event->id) : route('notifications.index') }}"
                                                        class="text-dark text-decoration-none">
                                                        {{ Str::limit($notification->title ?? 'No title', 60) }}
                                                    </a>
                                                </div>
                                                <div class="notification-meta">
                                                    <span>{{ $notification->created_at->diffForHumans() }}</span>
                                                    <div class="notification-actions-compact">
                                                        @if(!$notification->read_at)
                                                            <form action="{{ route('notifications.read', $notification) }}" method="POST">
                                                                @csrf
                                                                <button
                                                                    type="submit"
                                                                    class="btn btn-sm btn-outline-primary btn-notification-compact"
                                                                    title="Mark as Read">
                                                                    <i class="bi bi-check2"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        @if(Auth::user()->role === 'admin')
                                                            <form action="{{ route('notifications.destroy', $notification) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this notification?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button
                                                                    type="submit"
                                                                    class="btn btn-sm btn-outline-danger btn-notification-compact"
                                                                    title="Delete Notification">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="empty-notifications">
                                        <i class="bi bi-bell-slash"></i>
                                        <p class="mb-0">No notifications</p>
                                    </li>
                                @endforelse
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-center small" href="{{ route('notifications.index') }}">View all notifications</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a
                                id="navbarDropdown"
                                class="nav-link dropdown-toggle d-flex align-items-center py-0"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                                    </div>
                                    <div class="flex-grow-1 ms-1 d-none d-lg-block">
                                        <div class="fw-medium">{{ Auth::user()->name }}</div>
                                        <small class="text-muted" style="font-size: 0.75rem;">{{ ucfirst(Auth::user()->role) }}</small>
                                    </div>
                                </div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end shadow">
                                <div class="dropdown-header">
                                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </div>
                                <div class="dropdown-divider"></div>

                                @if(Auth::user()->role === 'admin')
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Admin Dashboard
                                    </a>
                                @else
                                    <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                    </a>
                                @endif

                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2"></i> Profile
                                </a>

                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-gear me-2"></i> Settings
                                </a>

                                <div class="dropdown-divider"></div>

                                <a
                                    class="dropdown-item text-danger"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>

    <footer class="bg-white mt-5  border-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; {{ date('Y') }} SSO - SNEC Students Organization. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-decoration-none text-muted me-3">Privacy Policy</a>
                    <a href="#" class="text-decoration-none text-muted">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

            // Add active class to current page nav link
            const currentUrl = window.location.href;
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                if (link.href === currentUrl) {
                    link.classList.add('active', 'fw-bold');
                }
            });

            // Navbar scroll effect
            const navbar = document.querySelector('.navbar');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 10) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
            
            // Auto-dismiss alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
    
    @yield('scripts')
    @stack('scripts')
</body>
</html>