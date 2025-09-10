<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seat Renewal Reminder</title>
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
            background: #3B82F6;
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
            background: #EFF6FF;
            border: 1px solid #3B82F6;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
        }

        .button {
            display: inline-block;
            background: #3B82F6;
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
            color: #3B82F6;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('storage/nstu_logo.png') }}" alt="NSTU Logo"
                style="max-width: 200px; height: auto; margin-bottom: 15px;">
            <h1>Seat Renewal Reminder</h1>
            <p>29 Days Remaining</p>
        </div>

        <div class="content">
            <h2>Dear {{ $allotment->student->name }},</h2>

            <p>This is a friendly reminder that your hall seat allocation will expire in <span
                    class="highlight">{{ $allotment->remaining_days }} days</span>.</p>

            <div class="alert">
                <strong>Important Information:</strong>
                <ul>
                    <li><strong>Seat Location:</strong> {{ $allotment->seat->floor }} Floor,
                        {{ $allotment->seat->block }} Block, Room {{ $allotment->seat->room_number }}, Bed
                        {{ $allotment->seat->bed_number }}</li>
                    <li><strong>Expiry Date:</strong>
                        {{ \Carbon\Carbon::parse($allotment->allocation_expiry_date)->format('F j, Y') }}</li>
                    <li><strong>Remaining Days:</strong> {{ $allotment->remaining_days }} days</li>
                </ul>
            </div>

            <p>To continue your stay in the hall, you need to submit a renewal application. The renewal process
                requires:</p>

            <ul>
                <li>Current number of semesters completed</li>
                <li>Last semester CGPA</li>
                <li>Upload of last semester result</li>
                <li>Additional comments (optional)</li>
            </ul>

            <p style="text-align: center;">
                <a href="{{ route('student.seat_renewal') }}" class="button">Apply for Renewal Now</a>
            </p>

            <p><strong>Note:</strong> This is the first of three reminder emails. You will receive additional reminders
                at 20 days and 10 days remaining if you haven't renewed by then.</p>

            <p>If you have any questions about the renewal process, please contact the hall administration.</p>

            <p>Best regards,<br>
                Hall Administration Team</p>
        </div>

        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>

</html>
