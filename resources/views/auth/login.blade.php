<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SNEC - Student Organization Portal</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

    /* Left Section */
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
      width: 120px; /* adjust size */
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

    /* Right Section */
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
      max-width: 400px;
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

    .forgot-link {
      display: block;
      margin-top: 8px;
      text-align: right;
      font-size: 13px;
      color: #0a1929;
      text-decoration: none;
    }

    .login-btn {
      width: 100%;
      padding: 12px;
      background-color: #0a1929;
      border: none;
      border-radius: 6px;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
    }

    .login-btn:hover {
      background-color: #1558b5;
    }

    .register-link {
      margin-top: 20px;
      text-align: center;
      font-size: 14px;
    }

    .register-link a {
      color: #1e6de7;
      text-decoration: none;
    }

    /* Responsive Fix */
    @media (max-width: 768px) {
      .login-wrapper {
        flex-direction: column; /* Stack vertically */
        height: auto; /* Allow content to expand */
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
      <!-- Replace 'logo.png' with your actual image -->
      <img src="images/SSO.png" alt="SNEC Logo">
      <h1>SNEC STUDENTS' ORGANIZATION <br>(SSO)</h1>
      
      <p>Empowering Future Leaders</p>
    </div>

    <!-- Login Form -->
    <div class="login-right">
      <div class="login-card">
        <h2>Log in</h2>
        <p>New Here? <a href="/register">Create an account</a></p>

        @if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div style="color: red; margin-bottom: 15px;">
        {{ session('error') }}
    </div>
@endif


        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="input-group">
            <label for="uid">UID</label>
            <input type="text" id="uid" name="uid" class="input-field" placeholder="Enter your UID" required autofocus>
          </div>

          <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="input-field" placeholder="Enter your password" required>
          </div>

          <a href="{{ route('password.request') }}" class="forgot-link">Forgot Password?</a>

          <button type="submit" class="login-btn">Sign in</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>



