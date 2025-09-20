<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Membership Card</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', 'DejaVu Sans', sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
            height: 100vh;
            width: 100%;
        }

        /* Wrapper to center content */
        .table-wrapper {
            display: table;
            width: 100%;
            height: 100vh;
            text-align: center;
        }

        .table-cell {
            display: table-cell;
            vertical-align: middle;
        }

        .card {
            width: 400px;
            margin: 0 auto;
            border-radius: 16px;
            padding: 24px;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }
        
        /* SSO Logo Background */
        .card::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            height: 300px;
            background-image: url("{{ asset('images/SSO.png') }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            opacity: 0.1;
            z-index: 0;
        }
        
        /* Green SSO Text Watermark */
        .card::before {
            content: 'SSO';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            font-weight: 800;
            color: rgba(16, 185, 129, 0.15);
            z-index: 0;
            letter-spacing: 5px;
        }
        
        .header, .member-details, .footer {
            position: relative;
            z-index: 1;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #eaeef2;
        }
        
        .org-name {
            font-size: 16px;
            font-weight: 700;
            color: #2c3e50;
            letter-spacing: 0.5px;
        }
        
        .verified-badge {
            background: #10b981;
            color: white;
            font-size: 10px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .member-details {
            margin-bottom: 20px;
            text-align: left;
        }
        
        .member-name {
            font-size: 20px;
            font-weight: 600;
            color: #1a2533;
            margin-bottom: 12px;
            letter-spacing: 0.3px;
        }
        
        .detail-row {
            display: flex;
            margin-bottom: 6px;
            align-items: center;
        }
        
        .detail-label {
            font-size: 12px;
            font-weight: 500;
            color: #64748b;
            width: 110px;
        }
        
        .detail-value {
            font-size: 13px;
            font-weight: 500;
            color: #334155;
        }
        
        .membership-number {
            background: #f1f5f9;
            padding: 10px 12px;
            border-radius: 8px;
            margin-top: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .membership-label {
            font-size: 12px;
            font-weight: 500;
            color: #64748b;
        }
        
        .membership-value {
            font-size: 14px;
            font-weight: 600;
            color: #4a6cf7;
            letter-spacing: 0.5px;
        }
        
        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 11px;
            color: #94a3b8;
            margin-top: 10px;
            padding-top: 12px;
            border-top: 1px solid #eaeef2;
        }
        
        .issue-date {
            font-weight: 500;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .logo-text {
            font-weight: 700;
            color: #4a6cf7;
        }
        
        .logo-image {
            width: 30px;
            height: 30px;
            background-image: url("{{ asset('images/SSO.png') }}");
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
        
        /* Top gradient bar */
        .top-bar {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, #4a6cf7, #6a82fb);
            border-radius: 8px 8px 0 0;
            z-index: 2;
        }
    </style>
</head>
<body>
    <div class="table-wrapper">
        <div class="table-cell">
            <div class="card">
                <div class="top-bar"></div>
                
                <div class="header">
                    <div class="org-name">SSO MEMBERSHIP CARD</div>
                    <div class="verified-badge">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        VERIFIED
                    </div>
                </div>
                
                <div class="member-details">
                    <div class="member-name">{{ $student->name }}</div>
                    
                    <div class="detail-row">
                        <div class="detail-label">UID:</div>
                        <div class="detail-value">{{ $student->uid }}</div>
                    </div>
                    
                    <div class="detail-row">
                        <div class="detail-label">College:</div>
                        <div class="detail-value">{{ $student->institution->name ?? 'N/A' }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Stream:</div>
                        <div class="detail-value">{{ ucfirst(str_replace('_', ' ', $student->stream)) }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Class:</div>
                        <div class="detail-value">{{ strtoupper($student->class) }}</div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-label">Address:</div>
                        <div class="detail-value">{{ $student->address }}</div>
                    </div>
                    
                    <div class="membership-number">
                        <div class="membership-label">Membership Number</div>
                        <div class="membership-value">{{ $student->membership_number }}</div>
                    </div>
                </div>
                
                <div class="footer">
                    <div class="issue-date">Issued on {{ \Carbon\Carbon::now()->format('d M Y') }}</div>
                    <div class="logo-container">
                        <div class="logo-image"></div>
                        <div class="logo-text">SNEC STUDENTS' ORGANIZATION</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
