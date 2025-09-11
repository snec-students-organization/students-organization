<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Institution Login - SNEC</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f9;
    }

    .login-wrapper {
      display: flex;
      height: 100vh;
    }

    /* Left Blue Section */
    .login-left {
      flex: 1;
      background-color: #0a1929;
      color: #fff;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 40px;
      text-align: center;
    }

    .login-left img {
      width: 120px;
      margin-bottom: 20px;
    }

    .login-left h1 {
      font-size: 24px;
      margin: 10px 0;
    }

    .login-left p {
      font-size: 16px;
      margin: 5px 0;
    }

    /* Right White Section */
    .login-right {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f9f9f9;
      padding: 20px;
    }

    .login-card {
      background: #fff;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 420px;
    }

    .login-card h2 {
      margin-bottom: 10px;
      color: #333;
    }

    .login-card p {
      margin-bottom: 20px;
      color: #666;
      font-size: 14px;
    }

    .form-label {
      font-weight: 500;
    }

    .btn-primary {
      background-color: #0a1929;
      border: none;
    }

    .btn-primary:hover {
      background-color: #0a1929;
    }

    .card-footer {
      margin-top: 20px;
      text-align: center;
      font-size: 13px;
      color: #666;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .login-wrapper {
        flex-direction: column;
        height: auto;
      }

      .login-left {
        flex: none;
        padding: 30px 20px;
        height: auto;
      }

      .login-right {
        flex: none;
        padding: 30px 20px;
        background-color: #fff;
      }

      .login-card {
        box-shadow: none;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="login-wrapper">
    <!-- Blue Section -->
    <div class="login-left">
      <!-- Replace 'institution-logo.png' with your logo -->
      <img src="/images/SSO.png" alt="Institution Logo">
      <h1>Institution Login</h1>
      <p>Secure access to your organization dashboard</p>
    </div>

    <!-- White Login Card -->
    <div class="login-right">
      <div class="login-card">
        <h2 class="mb-3">Sign In</h2>
        <p>Please login with your institutional email and password</p>

        {{-- Flash Message --}}
        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        <form method="POST" action="{{ route('institution.login.submit') }}">
          @csrf

          {{-- Email --}}
          <div class="mb-3">
            <label for="email" class="form-label">Institution Email</label>
            <input type="email" name="email" id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required autofocus>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Password --}}
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password"
                   class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          {{-- Submit --}}
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-box-arrow-in-right"></i> Login
            </button>
          </div>
        </form>

        <div class="card-footer">
          <small>Need help? Contact system admin</small>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
