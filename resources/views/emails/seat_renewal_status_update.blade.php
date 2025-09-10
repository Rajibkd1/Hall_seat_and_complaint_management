<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seat Renewal Status Update</title>
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

        .status-approved {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }

        .status-rejected {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
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
        <img src="{{ asset('storage/nstu_logo.png') }}" alt="NSTU Logo"
            style="max-width: 200px; height: auto; margin-bottom: 15px;">
        <h2>🏠 Hall Seat Renewal Status Update</h2>
        <p>Noakhali Science and Technology University</p>
    </div>

    <div class="content">
        <h3>Dear {{ $renewalApplication->student->name }},</h3>

        @if ($status === 'approved')
            <div class="status-approved">
                <strong>✅ Congratulations!</strong> Your seat renewal application has been approved.
            </div>

            <p>We are pleased to inform you that your seat renewal application has been successfully approved. Your hall
                seat allocation has been extended for another year.</p>

            <div class="info-box">
                <h4>Renewal Details:</h4>
                <ul>
                    <li><strong>Application ID:</strong> #{{ $renewalApplication->renewal_id }}</li>
                    <li><strong>Seat:</strong> {{ $renewalApplication->allotment->seat->floor }} Floor,
                        {{ $renewalApplication->allotment->seat->block }} Block, Room
                        {{ $renewalApplication->allotment->seat->room_number }}, Bed
                        {{ $renewalApplication->allotment->seat->bed_number }}</li>
                    <li><strong>New Expiry Date:</strong>
                        {{ \Carbon\Carbon::parse($renewalApplication->allotment->allocation_expiry_date)->format('F d, Y') }}
                    </li>
                    <li><strong>Approved By:</strong> {{ $renewalApplication->reviewer->name ?? 'Hall Administration' }}
                    </li>
                    <li><strong>Approved On:</strong>
                        {{ \Carbon\Carbon::parse($renewalApplication->reviewed_at)->format('F d, Y \a\t g:i A') }}</li>
                </ul>
            </div>

            <p>You can continue to stay in your current seat. Please ensure you follow all hall rules and regulations.
            </p>
        @else
            <div class="status-rejected">
                <strong>❌ Application Update:</strong> Your seat renewal application has been reviewed.
            </div>

            <p>We regret to inform you that your seat renewal application could not be approved at this time.</p>

            <div class="info-box">
                <h4>Application Details:</h4>
                <ul>
                    <li><strong>Application ID:</strong> #{{ $renewalApplication->renewal_id }}</li>
                    <li><strong>Seat:</strong> {{ $renewalApplication->allotment->seat->floor }} Floor,
                        {{ $renewalApplication->allotment->seat->block }} Block, Room
                        {{ $renewalApplication->allotment->seat->room_number }}, Bed
                        {{ $renewalApplication->allotment->seat->bed_number }}</li>
                    <li><strong>Reviewed By:</strong>
                        {{ $renewalApplication->reviewer->name ?? 'Hall Administration' }}</li>
                    <li><strong>Reviewed On:</strong>
                        {{ \Carbon\Carbon::parse($renewalApplication->reviewed_at)->format('F d, Y \a\t g:i A') }}</li>
                </ul>
            </div>

            @if ($renewalApplication->admin_notes)
                <div class="info-box">
                    <h4>Admin Notes:</h4>
                    <p>{{ $renewalApplication->admin_notes }}</p>
                </div>
            @endif

            <p>You may need to vacate your current seat by the expiry date. Please contact the hall administration for
                further assistance.</p>
        @endif

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('student.dashboard') }}" class="button">View Dashboard</a>
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
