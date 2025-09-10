<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seat Renewal Reminder - URGENT</title>
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
            background: #F59E0B;
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

        .alert {
            background: #FEF3C7;
            border: 1px solid #F59E0B;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
        }

        .urgent {
            background: #FEE2E2;
            border: 1px solid #EF4444;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
        }

        .button {
            display: inline-block;
            background: #F59E0B;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            margin: 15px 0;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }

        .highlight {
            color: #F59E0B;
            font-weight: bold;
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
            <h1>⚠️ URGENT: Seat Renewal Reminder</h1>
            <p>20 Days Remaining</p>
        </div>

        <div class="content">
            <h2>Dear {{ $allotment->student->name }},</h2>

            <div class="urgent">
                <strong class="urgent-text">URGENT NOTICE:</strong> Your hall seat allocation will expire in <span
                    class="highlight">{{ $allotment->remaining_days }} days</span>. This is your second reminder.
            </div>

            <div class="alert">
                <strong>Seat Information:</strong>
                <ul>
                    <li><strong>Location:</strong> {{ $allotment->seat->floor }} Floor, {{ $allotment->seat->block }}
                        Block, Room {{ $allotment->seat->room_number }}, Bed {{ $allotment->seat->bed_number }}</li>
                    <li><strong>Expiry Date:</strong>
                        {{ \Carbon\Carbon::parse($allotment->allocation_expiry_date)->format('F j, Y') }}</li>
                    <li><strong>Remaining Days:</strong> {{ $allotment->remaining_days }} days</li>
                </ul>
            </div>

            <p><strong>Action Required:</strong> You must submit your renewal application immediately to avoid losing
                your seat allocation.</p>

            <p>The renewal application requires:</p>
            <ul>
                <li>Current number of semesters completed</li>
                <li>Last semester CGPA (minimum 2.0 required)</li>
                <li>Upload of last semester result document</li>
                <li>Additional comments (optional)</li>
            </ul>

            <p style="text-align: center;">
                <a href="{{ route('student.seat_renewal') }}" class="button">Apply for Renewal Now</a>
            </p>

            <div class="urgent">
                <strong>Important:</strong> If you do not renew your seat within the next 20 days, your seat will be
                allocated to another student. This is your second reminder - you will receive one final reminder at 10
                days remaining.
            </div>

            <p>For immediate assistance, please contact the hall administration office.</p>

            <p>Best regards,<br>
                Hall Administration Team</p>
        </div>

        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>

</html>
