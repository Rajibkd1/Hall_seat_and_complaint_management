<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status Update</title>
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
            background-color: #4f46e5;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            background-color: #f9fafb;
            padding: 30px;
            border-radius: 0 0 8px 8px;
            border: 1px solid #e5e7eb;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            margin: 10px 0;
        }

        .status-approved {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-rejected {
            background-color: #fef2f2;
            color: #dc2626;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-waitlisted {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .details {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px solid #e5e7eb;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Application Status Update</h1>
    </div>

    <div class="content">
        <h2>Dear {{ $application->student_name }},</h2>

        <p>We are writing to inform you that the status of your seat application has been updated.</p>

        <div class="status-badge status-{{ $application->status }}">
            New Status: {{ ucfirst($application->status) }}
        </div>

        <div class="details">
            <h3>Application Details:</h3>
            <p><strong>Application ID:</strong> #{{ $application->application_id }}</p>
            <p><strong>Student Name:</strong> {{ $application->student_name }}</p>
            <p><strong>Department:</strong> {{ $application->department }}</p>
            <p><strong>Academic Year:</strong> {{ $application->academic_year }}</p>
            <p><strong>Application Date:</strong> {{ $application->application_date->format('F j, Y') }}</p>
        </div>

        @if ($message)
            <div class="details">
                <h3>Message from Administration:</h3>
                <p style="white-space: pre-line;">{{ $message }}</p>
            </div>
        @endif

        <p>If you have any questions or need further assistance, please don't hesitate to contact the administration
            office.</p>

        <div class="footer">
            <p>This is an automated message from the Hall Seat Management System.</p>
            <p>Please do not reply to this email.</p>
        </div>
    </div>
</body>

</html>
