<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activation Confirmation</title>
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
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }

        .button {
            display: inline-block;
            background: #28a745;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 14px;
        }

        .highlight {
            background: #e3f2fd;
            padding: 15px;
            border-left: 4px solid #2196f3;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>🎉 Account Activated Successfully!</h1>
        <p>Welcome to NSTU Hall Management System</p>
    </div>

    <div class="content">
        <h2>Dear {{ $student->name }},</h2>

        <p>Great news! Your account has been successfully activated by the administration. You can now access all
            features of the NSTU Hall Management System.</p>

        <div class="highlight">
            <h3>✅ Your Account Details:</h3>
            <ul>
                <li><strong>Name:</strong> {{ $student->name }}</li>
                <li><strong>University ID:</strong> {{ $student->university_id }}</li>
                <li><strong>Email:</strong> {{ $student->email }}</li>
                <li><strong>Department:</strong> {{ $student->department }}</li>
                <li><strong>Activation Date:</strong>
                    {{ $student->activated_at ? $student->activated_at->format('F d, Y \a\t g:i A') : 'N/A' }}</li>
            </ul>
        </div>

        <p>You can now:</p>
        <ul>
            <li>Apply for hall seats</li>
            <li>Submit complaints and feedback</li>
            <li>View hall notices and announcements</li>
            <li>Manage your profile and preferences</li>
            <li>Track your applications and requests</li>
        </ul>

        <div style="text-align: center;">
            <a href="{{ $loginUrl }}" class="button">Login to Your Account</a>
        </div>

        <p>If you have any questions or need assistance, please don't hesitate to contact the hall administration.</p>

        <p>Thank you for choosing NSTU Hall Management System!</p>
    </div>

    <div class="footer">
        <p><strong>NSTU Hall Management System</strong></p>
        <p>This is an automated message. Please do not reply to this email.</p>
        <p>© {{ date('Y') }} NSTU. All rights reserved.</p>
    </div>
</body>

</html>
