<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }

        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 8px 8px;
            border: 1px solid #e9ecef;
        }

        .message-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #667eea;
            margin: 20px 0;
        }

        .field {
            margin-bottom: 15px;
        }

        .field-label {
            font-weight: bold;
            color: #495057;
            margin-bottom: 5px;
        }

        .field-value {
            color: #6c757d;
            padding: 8px 12px;
            background: #f8f9fa;
            border-radius: 4px;
            border: 1px solid #e9ecef;
        }

        .message-content {
            background: white;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #e9ecef;
            white-space: pre-wrap;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }

        .student-info {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            border-left: 4px solid #2196f3;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>New Contact Message</h1>
        <p>Hall Management System</p>
    </div>

    <div class="content">
        <p>You have received a new contact message from the Hall Management System contact form.</p>

        <div class="message-box">
            <div class="field">
                <div class="field-label">From:</div>
                <div class="field-value">{{ $contactMessage->name }} ({{ $contactMessage->email }})</div>
            </div>

            <div class="field">
                <div class="field-label">Subject:</div>
                <div class="field-value">{{ $contactMessage->subject }}</div>
            </div>

            <div class="field">
                <div class="field-label">Message:</div>
                <div class="message-content">{{ $contactMessage->message }}</div>
            </div>
        </div>

        @if ($contactMessage->student)
            <div class="student-info">
                <h3>Student Information</h3>
                <div class="field">
                    <div class="field-label">Student ID:</div>
                    <div class="field-value">{{ $contactMessage->student->student_id }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Department:</div>
                    <div class="field-value">{{ $contactMessage->student->department ?? 'N/A' }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Session:</div>
                    <div class="field-value">{{ $contactMessage->student->session_year ?? 'N/A' }}</div>
                </div>
            </div>
        @endif

        <div class="field">
            <div class="field-label">Submitted:</div>
            <div class="field-value">{{ $contactMessage->created_at->format('F j, Y \a\t g:i A') }}</div>
        </div>

        @if ($contactMessage->ip_address)
            <div class="field">
                <div class="field-label">IP Address:</div>
                <div class="field-value">{{ $contactMessage->ip_address }}</div>
            </div>
        @endif
    </div>

    <div class="footer">
        <p>This message was sent from the Hall Management System contact form.</p>
        <p>Please respond to the sender directly at: {{ $contactMessage->email }}</p>
    </div>
</body>

</html>
