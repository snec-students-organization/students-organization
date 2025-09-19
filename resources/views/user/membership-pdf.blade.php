<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Membership Card</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        .card {
            width: 400px;
            height: 220px;
            border: 2px solid #333;
            border-radius: 12px;
            padding: 20px;
            margin: 0 auto;
            text-align: center;
            background: #f9f9f9;
        }
        .header {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .member-name {
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0;
        }
        .uid, .college, .membership {
            font-size: 14px;
            margin: 4px 0;
        }
        .footer {
            position: absolute;
            bottom: 10px;
            width: 100%;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">SSO Membership Card</div>

        <div class="member-name">{{ $student->name }}</div>

        <div class="uid"><strong>UID:</strong> {{ $student->uid }}</div>
        <div class="college"><strong>College:</strong> {{ $student->institution->name ?? 'N/A' }}</div>
        <div class="membership"><strong>Membership No:</strong> {{ $student->membership_number }}</div>

        <div class="footer">
            Issued on {{ \Carbon\Carbon::now()->format('d M Y') }}
        </div>
    </div>
</body>
</html>
