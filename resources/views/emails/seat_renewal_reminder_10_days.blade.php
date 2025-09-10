<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FINAL NOTICE - Seat Renewal Required</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: #EF4444;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 8px 8px;
        }

        .final-notice {
            background: #FEE2E2;
            border: 2px solid #EF4444;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
            text-align: center;
        }

        .alert {
            background: #FEF2F2;
            border: 1px solid #EF4444;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
        }

        .button {
            display: inline-block;
            background: #EF4444;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 6px;
            margin: 15px 0;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }

        .highlight {
            color: #EF4444;
            font-weight: bold;
            font-size: 18px;
        }

        .urgent-text {
            color: #EF4444;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('storage/nstu_logo.png') }}" alt="NSTU Logo"
                style="max-width: 200px; height: auto; margin-bottom: 15px;">
            <h1>🚨 FINAL NOTICE</h1>
            <p>Seat Renewal Required - 10 Days Left</p>
        </div>

        <div class="content">
            <h2>Dear {{ $allotment->student->name }},</h2>

            <div class="final-notice">
                <h3 class="urgent-text">FINAL NOTICE - IMMEDIATE ACTION REQUIRED</h3>
                <p>Your hall seat allocation will expire in <span class="highlight">{{ $allotment->remaining_days }}
                        days</span>.</p>
                <p><strong>This is your final reminder!</strong></p>
            </div>

            <div class="alert">
                <strong>Critical Information:</strong>
                <ul>
                    <li><strong>Seat Location:</strong> {{ $allotment->seat->floor }} Floor,
                        {{ $allotment->seat->block }} Block, Room {{ $allotment->seat->room_number }}, Bed
                        {{ $allotment->seat->bed_number }}</li>
                    <li><strong>Expiry Date:</strong>
                        {{ \Carbon\Carbon::parse($allotment->allocation_expiry_date)->format('F j, Y') }}</li>
                    <li><strong>Remaining Days:</strong> {{ $allotment->remaining_days }} days</li>
                </ul>
            </div>

            <p class="urgent-text">⚠️ <strong>IMMEDIATE ACTION REQUIRED:</strong> You must submit your renewal
                application TODAY to avoid losing your seat allocation.</p>

            <p><strong>Renewal Requirements:</strong></p>
            <ul>
                <li>Current number of semesters completed</li>
                <li>Last semester CGPA (minimum 2.0 required)</li>
                <li>Upload of last semester result document (PDF/JPG/PNG)</li>
                <li>Additional comments (optional)</li>
            </ul>

            <p style="text-align: center;">
                <a href="{{ route('student.seat_renewal') }}" class="button">RENEW NOW - FINAL CHANCE</a>
            </p>

            <div class="final-notice">
                <h4 class="urgent-text">CONSEQUENCES OF NOT RENEWING:</h4>
                <ul style="text-align: left; margin: 10px 0;">
                    <li>Your seat will be automatically allocated to another student</li>
                    <li>You will need to reapply for a new seat allocation</li>
                    <li>No guarantee of getting the same or any seat</li>
                    <li>You may need to vacate the hall immediately</li>
                </ul>
            </div>

            <p><strong>Contact Information:</strong><br>
                For immediate assistance, contact the hall administration office immediately.<br>
                Phone: [Hall Office Number]<br>
                Email: [Hall Email]</p>

            <p>This is your final opportunity to renew your seat allocation.</p>

            <p>Best regards,<br>
                Hall Administration Team</p>
        </div>

        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>

</html>
