<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $subject ?? 'Email' }}</title>
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
            text-align: center;
        }

        .logo {
            max-width: 200px;
            height: auto;
            margin-bottom: 15px;
        }

        .content {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
        }

        .message-content {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 15px 0;
            white-space: pre-line;
        }

        .info-box {
            background-color: #e7f3ff;
            border: 1px solid #b3d9ff;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            font-size: 14px;
            color: #666;
            text-align: center;
        }

        .admin-signature {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
            border-radius: 0 5px 5px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ asset('storage/nstu_logo.png') }}" alt="NSTU Logo" class="logo">
        <h2>🏠 Hall Seat Management System</h2>
        <p>Noakhali Science and Technology University</p>
    </div>

    <div class="content">
        <h3>Dear {{ $renewalApplication->student->name }},</h3>

        <div class="info-box">
            <h4>Application Details:</h4>
            <ul>
                <li><strong>Application ID:</strong> #{{ $renewalApplication->renewal_id }}</li>
                <li><strong>Current Seat:</strong> {{ $renewalApplication->allotment->seat->floor }} Floor,
                    {{ $renewalApplication->allotment->seat->block }} Block, Room
                    {{ $renewalApplication->allotment->seat->room_number }}, Bed
                    {{ $renewalApplication->allotment->seat->bed_number }}</li>
                <li><strong>Application Status:</strong> {{ ucfirst($renewalApplication->status) }}</li>
            </ul>
        </div>

        <div class="message-content">{!! nl2br(e($emailMessage ?? '')) !!}</div>

        <div class="admin-signature">
            <p><strong>From:</strong> {{ $adminName ?? 'Hall Administration' }}</p>
            <p><strong>Hall Administration</strong></p>
            <p>Noakhali Science and Technology University</p>
        </div>

        <p>If you have any questions or need clarification, please contact the hall administration office.</p>
    </div>

    <div class="footer">
        <p>This is an automated message from the Hall Seat Management System.</p>
        <p>Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} Noakhali Science and Technology University. All rights reserved.</p>
    </div>
</body>

</html>
