<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Membership Certificate</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background: #f2f2f2;
            padding: 40px;
        }

        .certificate {
            background: #fff;
            padding: 50px 60px;
            border: 8px solid #d4af37; /* Gold color */
            border-radius: 12px;
            max-width: 900px;
            margin: auto;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .header-title {
            text-align: center;
            font-size: 34px;
            font-weight: bold;
            color: #2f2f2f;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .sub-title {
            text-align: center;
            font-size: 16px;
            color: #444;
            margin-bottom: 30px;
        }

        .org-info {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
            color: #333;
        }

        .line {
            width: 120px;
            height: 3px;
            background: #d4af37;
            margin: 20px auto;
        }

        .content {
            margin-top: 30px;
            font-size: 18px;
            line-height: 1.7;
            color: #111;
        }

        .info-row {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #333;
        }

        /* Footer */
        .footer {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .verified {
            text-align: center;
            margin-top: 40px;
        }

        .verified span {
            background: #e8f8f1;
            border: 2px solid #198754;
            padding: 8px 18px;
            border-radius: 25px;
            color: #198754;
            font-weight: bold;
            font-size: 18px;
        }

        .sign-box {
            border-top: 2px solid #444;
            padding-top: 5px;
            width: 200px;
            text-align: center;
            font-size: 14px;
            color: #444;
        }
    </style>
</head>
<body>

    <div class="certificate">

        <!-- Certificate Header -->
        <div class="header-title">MEMBERSHIP CERTIFICATE</div>

        <div class="sub-title">
            SNEC STUDENTS ORGANIZATION (SSO) <br>
            Under <b>SAMASTHA NATIONAL EDUCATION COUNCIL (SNEC)</b>
        </div>

        <div class="line"></div>

        <!-- Certificate Intro Section -->
        <div class="org-info">
            This is to certify that the following details are officially recorded
            in the membership registry of the organization.
        </div>

        <!-- Certificate Content -->
        <div class="content">
            <div class="info-row">
                <span class="label">Organization Name:</span>
                {{ $institution->name }}
            </div>

            <div class="info-row">
                <span class="label">Membership Number:</span>
                {{ $institution->membership_number }}
            </div>

            <div class="info-row">
                <span class="label">College Name:</span>
                {{ $selectedData->college_name ?? 'N/A' }}
            </div>

            <div class="info-row">
                <span class="label">Email Address:</span>
                {{ $selectedData->email ?? $institution->email }}
            </div>
        </div>

        <!-- Verified Badge -->
        <div class="verified">
            <span>✔ Verified Member</span>
        </div>

        <!-- Footer Signatures -->
        <div class="footer">
            <div class="sign-box">Authorized Signature</div>
            <div class="sign-box">Organization Seal</div>
        </div>

    </div>

</body>
</html>
