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
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .content {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
        }

        .alert {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }

        .info-box {
            background-color: #e7f3ff;
            border: 1px solid #b3d9ff;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }

        .button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 15px 0;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>🏠 Hall Seat Renewal Reminder</h2>
        <p>Noakhali Science and Technology University</p>
    </div>

    <div class="content">
        <h3>Dear {{ $allotment->student->name }},</h3>

        <div class="alert">
            <strong>⚠️ Important Notice:</strong> Your hall seat allocation is expiring soon!
        </div>

        <p>This is a reminder that your current hall seat allocation will expire in
            <strong>{{ $allotment->remaining_days }} days</strong>.</p>

        <div class="info-box">
            <h4>Seat Details:</h4>
            <ul>
                <li><strong>Seat:</strong> {{ $allotment->seat->floor }} Floor, {{ $allotment->seat->block }} Block,
                    Room {{ $allotment->seat->room_number }}, Bed {{ $allotment->seat->bed_number }}</li>
                <li><strong>Allocation Date:</strong>
                    {{ \Carbon\Carbon::parse($allotment->start_date)->format('F d, Y') }}</li>
                <li><strong>Expiry Date:</strong>
                    {{ \Carbon\Carbon::parse($allotment->allocation_expiry_date)->format('F d, Y') }}</li>
                <li><strong>Remaining Days:</strong> {{ $allotment->remaining_days }} days</li>
            </ul>
        </div>

        <p>To continue your stay in the hall, you need to submit a seat renewal application. The renewal process
            requires:</p>

        <ul>
            <li>Current number of semesters completed</li>
            <li>Last semester CGPA</li>
            <li>Upload of last semester result</li>
            <li>Optional additional comments</li>
        </ul>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('student.seat_renewal') }}" class="button">Apply for Seat Renewal</a>
        </div>

        <p><strong>Important:</strong> Please submit your renewal application as soon as possible to avoid any
            inconvenience. Late applications may not be considered.</p>

        <p>If you have any questions or need assistance, please contact the hall administration office.</p>
    </div>

    <div class="footer">
        <p>This is an automated message from the Hall Seat Management System.</p>
        <p>Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} Noakhali Science and Technology University. All rights reserved.</p>
    </div>
</body>

</html>
