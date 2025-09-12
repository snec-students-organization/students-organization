<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SNEC - Student Organization Registration</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f9;
    }

    .register-wrapper {
      display: flex;
      height: 100vh;
    }

    /* Left Section */
    .register-left {
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

    .register-left img {
      width: 120px;
      margin-bottom: 20px;
    }

    .register-left h1 {
      font-size: 24px;
      margin: 10px 0;
    }

    .register-left p {
      font-size: 16px;
      margin: 5px 0;
    }

    /* Right Section */
    .register-right {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f9f9f9;
      padding: 20px;
    }

    .register-card {
      background: #fff;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 450px;
    }

    .register-card h2 {
      margin-bottom: 10px;
      color: #333;
    }

    .register-card p {
      margin-bottom: 20px;
      color: #666;
      font-size: 14px;
    }

    .input-group {
      margin-bottom: 20px;
    }

    .input-group label {
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
      color: #444;
    }

    .input-field {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
    }

    .error-message {
      font-size: 13px;
      color: #d9534f;
      margin-top: 5px;
    }

    .forgot-link, .login-link {
      font-size: 13px;
      color: #1e6de7;
      text-decoration: none;
    }

    .register-btn {
      width: 100%;
      padding: 12px;
      background-color: #0a1929;
      border: none;
      border-radius: 6px;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
    }

    .register-btn:hover {
      background-color: #0a1929;
    }

    .form-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 20px;
    }

    .terms {
      margin-top: 20px;
      font-size: 12px;
      text-align: center;
      color: #666;
    }

    .terms a {
      color: #0a1929;
      text-decoration: none;
    }

    /* Password strength */
    .password-strength {
      margin-top: 5px;
      height: 6px;
      background: #eee;
      border-radius: 4px;
      overflow: hidden;
    }

    .strength-meter {
      height: 100%;
      width: 0%;
      transition: width 0.3s ease;
    }

    .strength-text {
      font-size: 12px;
      margin-top: 5px;
      color: #666;
    }

    /* Responsive Fix */
    @media (max-width: 768px) {
      .register-wrapper {
        flex-direction: column;
        height: auto;
      }

      .register-left {
        flex: none;
        padding: 30px 20px;
        height: auto;
      }

      .register-right {
        flex: none;
        padding: 30px 20px;
        background-color: #fff;
      }

      .register-card {
        box-shadow: none;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="register-wrapper">
    <!-- Blue Section -->
    <div class="register-left">
      <!-- Replace 'logo.png' with your actual image -->
      <img src="images/SSO.png" alt="SNEC Logo">
      <h1>SNEC STUDENTS' ORGANIZATION <br>(SSO)</h1>
      <p>Empowering Future Leaders</p>
    </div>

    <!-- Register Form -->
    <div class="register-right">
      <div class="register-card">
        <h2>Create Account</h2>
        <p>Already registered? <a href="{{ route('login') }}">Sign in here</a></p>

        <form method="POST" action="{{ route('register') }}" id="registerForm">
          @csrf
          <!-- UID -->
          <div class="input-group">
            <label for="uid">Student UID</label>
            <input type="text" id="uid" name="uid" class="input-field" placeholder="Enter your student UID" value="{{ old('uid') }}" required autofocus>
            @if($errors->get('uid'))
              <div class="error-message">
                {{ $errors->first('uid') }}
              </div>
            @endif
          </div>

          <!-- Full Name -->
          <div class="input-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" class="input-field" placeholder="Enter your full name" value="{{ old('name') }}" required>
            @if($errors->get('name'))
              <div class="error-message">
                {{ $errors->first('name') }}
              </div>
            @endif
          </div>

          <!-- Email -->
          <div class="input-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" class="input-field" placeholder="Enter your email" value="{{ old('email') }}" required>
            @if($errors->get('email'))
              <div class="error-message">
                {{ $errors->first('email') }}
              </div>
            @endif
          </div>

          <!-- Password -->
          <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="input-field" placeholder="Create a password" required autocomplete="new-password">

            <div class="password-strength">
              <div class="strength-meter" id="passwordStrengthMeter"></div>
            </div>
            <div class="strength-text" id="passwordStrengthText">Password strength</div>

            @if($errors->get('password'))
              <div class="error-message">
                {{ $errors->first('password') }}
              </div>
            @endif
          </div>

          <!-- Confirm Password -->
          <div class="input-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="input-field" placeholder="Confirm your password" required>
            @if($errors->get('password_confirmation'))
              <div class="error-message">
                {{ $errors->first('password_confirmation') }}
              </div>
            @endif
          </div>

          <div class="form-actions">
            <a href="{{ route('login') }}" class="login-link"><i class="fas fa-arrow-left"></i> Back to Login</a>
            <button type="submit" class="register-btn"><i class="fas fa-user-plus"></i> Register</button>
          </div>
        </form>

        <div class="terms">
          By registering, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
