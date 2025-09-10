<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Release Notification</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #dc3545;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: rgba(220, 53, 69, 0.1);
            border-radius: 8px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 4px;
        }

        .header h1 {
            color: #dc3545;
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }

        .header p {
            color: #6c757d;
            margin: 10px 0 0 0;
            font-size: 16px;
        }

        .content {
            margin-bottom: 30px;
        }

        .greeting {
            font-size: 18px;
            color: #495057;
            margin-bottom: 20px;
        }

        .seat-info {
            background-color: #f8f9fa;
            border-left: 4px solid #dc3545;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }

        .seat-info h3 {
            color: #dc3545;
            margin: 0 0 15px 0;
            font-size: 18px;
        }

        .seat-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 15px;
        }

        .seat-detail {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .seat-detail:last-child {
            border-bottom: none;
        }

        .seat-detail strong {
            color: #495057;
        }

        .reason-section {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .reason-section h3 {
            color: #856404;
            margin: 0 0 15px 0;
            font-size: 18px;
        }

        .reason-text {
            color: #856404;
            font-size: 16px;
            line-height: 1.6;
            background-color: #ffffff;
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #ffeaa7;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            color: #6c757d;
            font-size: 14px;
        }

        .contact-info {
            background-color: #e3f2fd;
            border: 1px solid #bbdefb;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }

        .contact-info h3 {
            color: #1976d2;
            margin: 0 0 10px 0;
        }

        .contact-info p {
            color: #1976d2;
            margin: 5px 0;
        }

        .important-note {
            background-color: #ffebee;
            border: 1px solid #ffcdd2;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            color: #c62828;
            font-weight: 500;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 20px;
            }

            .seat-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="{{ asset('storage/nstu_logo.png') }}" alt="NSTU Logo" />
            </div>
            <h1>Seat Release Notification</h1>
            <p>NSTU Hall Management System</p>
        </div>

        <div class="content">
            <div class="greeting">
                Dear {{ $studentName }},
            </div>

            <p>We regret to inform you that your seat allocation has been released by the Provost. Please find the
                details below:</p>

            <div class="seat-info">
                <h3>📍 Released Seat Details</h3>
                <div class="seat-details">
                    <div class="seat-detail">
                        <span><strong>Room Number:</strong></span>
                        <span>{{ $seatDetails['room_number'] }}</span>
                    </div>
                    <div class="seat-detail">
                        <span><strong>Bed Number:</strong></span>
                        <span>{{ $seatDetails['bed_number'] }}</span>
                    </div>
                    <div class="seat-detail">
                        <span><strong>Floor:</strong></span>
                        <span>{{ $seatDetails['floor'] }}</span>
                    </div>
                    <div class="seat-detail">
                        <span><strong>Block:</strong></span>
                        <span>{{ $seatDetails['block'] }}</span>
                    </div>
                </div>
                <div class="seat-detail">
                    <span><strong>Release Date:</strong></span>
                    <span>{{ date('F j, Y \a\t g:i A') }}</span>
                </div>
                <div class="seat-detail">
                    <span><strong>Released By:</strong></span>
                    <span>{{ $releasedBy }}</span>
                </div>
            </div>

            <div class="reason-section">
                <h3>📝 Reason for Release</h3>
                <div class="reason-text">
                    {{ $releaseReason }}
                </div>
            </div>

            <div class="important-note">
                <strong>⚠️ Important:</strong> You are required to vacate the seat immediately. Please collect your
                belongings and complete the checkout process as soon as possible.
            </div>

            <p>If you have any questions or concerns regarding this seat release, please contact the hall administration
                immediately.</p>

            <div class="contact-info">
                <h3>📞 Contact Information</h3>
                <p><strong>Hall Administration Office</strong></p>
                <p>Phone: +880-XXX-XXXXXXX</p>
                <p>Email: hall.admin@university.edu</p>
                <p>Office Hours: 9:00 AM - 5:00 PM (Sunday to Thursday)</p>
            </div>

            <p>We apologize for any inconvenience this may cause and appreciate your understanding.</p>

            <p>Best regards,<br>
                <strong>Hall Management System</strong><br>
                University Administration
            </p>
        </div>

        <div class="footer">
            <p>This is an automated notification from the Hall Management System.</p>
            <p>Please do not reply to this email. For assistance, contact the hall administration office.</p>
            <p>&copy; {{ date('Y') }} University Hall Management System. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
