<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Membership Card</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; background: #f8f9fa; }
        .card {
            width: 100%;
            border: 2px solid #198754;
            border-radius: 12px;
            padding: 20px;
            background: #fff;
        }
        .header {
            text-align: center;
            color: #198754;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .row { margin-bottom: 8px; }
        .label { font-weight: bold; color: #333; }
        .value { color: #000; }
        .verified { text-align: right; font-size: 18px; color: #198754; }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">Institution Membership Card</div>
        
        <div class="row"><span class="label">Organization:</span> <span class="value">{{ $institution->name }}</span></div>
        <div class="row"><span class="label">Membership No:</span> <span class="value">{{ $institution->membership_number }}</span></div>
        <div class="row"><span class="label">College:</span> <span class="value">{{ $selectedData->college_name ?? 'N/A' }}</span></div>
        <div class="row"><span class="label">Email:</span> <span class="value">{{ $selectedData->email ?? $institution->email }}</span></div>

        <div class="verified">✔ Verified Organization</div>
    </div>
</body>
</html>
