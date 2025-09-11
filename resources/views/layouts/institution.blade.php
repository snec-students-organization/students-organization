<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Institution Dashboard')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: #3b5998;
            --secondary-color: #f8f9fa;
            --accent-color: #6c757d;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --transition-speed: 0.3s;
        }
        
        body {
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fb;
        }
        
        /* Sidebar styles */
        #wrapper {
            display: flex;
            width: 100%;
        }
        
        #sidebar-wrapper {
            min-width: var(--sidebar-width);
            max-width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            transition: all var(--transition-speed);
            z-index: 1000;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            background: linear-gradient(to bottom, var(--primary-color), #2d4373);
            color: white;
        }
        
        #wrapper.toggled #sidebar-wrapper {
            margin-left: calc(var(--sidebar-width) * -1);
        }
        
        #page-content-wrapper {
            width: 100%;
            margin-left: var(--sidebar-width);
            transition: margin-left var(--transition-speed);
        }
        
        #wrapper.toggled #page-content-wrapper {
            margin-left: 0;
        }
        
        .sidebar-heading {
            padding: 20px 15px;
            font-size: 1.2rem;
            background-color: rgba(0, 0, 0, 0.2);
        }
        
        .list-group-item {
            background: transparent;
            border: none;
            border-radius: 0;
            padding: 15px 20px;
            color: rgba(255, 255, 255, 0.9);
            border-left: 4px solid transparent;
            transition: all 0.2s;
        }
        
        .list-group-item:hover, 
        .list-group-item:focus {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: white;
        }
        
        .list-group-item.active {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            font-weight: 600;
            border-left-color: white;
        }
        
        .list-group-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        /* Navbar styles */
        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 15px;
        }
        
        #menu-toggle {
            border: none;
            background-color: var(--primary-color);
            padding: 8px 12px;
        }
        
        /* Main content area */
        .main-content {
            padding: 20px;
            min-height: calc(100vh - 160px);
        }
        
        /* Footer */
        footer {
            padding: 15px;
            background-color: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            #sidebar-wrapper {
                margin-left: calc(var(--sidebar-width) * -1);
            }
            
            #page-content-wrapper {
                margin-left: 0;
            }
            
            #wrapper.toggled #sidebar-wrapper {
                margin-left: 0;
            }
            
            #wrapper.toggled #page-content-wrapper {
                margin-left: var(--sidebar-width);
            }
            
            #wrapper.toggled .overlay {
                display: block;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }
        }
        
        /* User welcome text */
        .user-welcome {
            font-weight: 500;
            color: var(--primary-color);
        }
        
        /* Card enhancements */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
            padding: 15px 20px;
            border-radius: 10px 10px 0 0 !important;
        }
    </style>

    @stack('styles')
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">
                <i class="bi bi-building"></i> Institution Panel
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('institution.dashboard') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('institution.students.index') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-people-fill"></i> Students
                </a>
                <a href="{{ route('institution.organization.form') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-building"></i> Organization Details
                </a>
                <a href="{{ route('institution.details.add') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-plus-circle"></i> Add Details
                </a>
                <a href="{{ route('payments.institution.create') }}" class="list-group-item list-group-item-action">
                    <i class="bi bi-credit-card"></i> Payments
                </a>
                <form action="{{ route('institution.logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="list-group-item list-group-item-action w-100 text-start">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <div class="container-fluid">
                    <button class="btn btn-primary" id="menu-toggle">
                        <i class="bi bi-list"></i>
                    </button>
                    <span class="navbar-brand ms-3 mb-0 h1 fs-4">@yield('page-title', 'Dashboard')</span>
                    <div class="ms-auto user-welcome">
                        <i class="bi bi-person-circle"></i> Welcome, {{ auth('institution')->user()->name }}
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid main-content">
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="bg-white text-center py-3">
                &copy; {{ date('Y') }} Your Institution Name. All rights reserved.
            </footer>
        </div>
        
        <!-- Overlay for mobile when sidebar is open -->
        <div class="overlay" style="display: none;"></div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sidebar Toggle Script -->
    <script>
        const toggleButton = document.getElementById('menu-toggle');
        const wrapper = document.getElementById('wrapper');
        const overlay = document.querySelector('.overlay');

        toggleButton.addEventListener('click', () => {
            wrapper.classList.toggle('toggled');
            
            // Show/hide overlay on mobile
            if (window.innerWidth < 992) {
                if (wrapper.classList.contains('toggled')) {
                    overlay.style.display = 'block';
                } else {
                    overlay.style.display = 'none';
                }
            }
        });
        
        // Close sidebar when clicking on overlay (mobile view)
        overlay.addEventListener('click', () => {
            wrapper.classList.remove('toggled');
            overlay.style.display = 'none';
        });
        
        // Adjust sidebar on resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) {
                overlay.style.display = 'none';
            } else if (wrapper.classList.contains('toggled')) {
                overlay.style.display = 'block';
            }
        });
    </script>

    @stack('scripts')
</body>
</html>

