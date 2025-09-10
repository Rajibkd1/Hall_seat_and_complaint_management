<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Assignment Confirmation</title>
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

        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.1);
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
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .content {
            padding: 30px;
        }

        .greeting {
            font-size: 18px;
            color: #1f2937;
            margin-bottom: 20px;
        }

        .message {
            font-size: 16px;
            line-height: 1.6;
            color: #4b5563;
            margin-bottom: 25px;
        }

        .seat-details {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }

        .seat-details h3 {
            color: #1f2937;
            margin: 0 0 15px 0;
            font-size: 18px;
            font-weight: 600;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #374151;
        }

        .detail-value {
            color: #1f2937;
            font-weight: 500;
        }

        .important-note {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
        }

        .important-note h4 {
            color: #92400e;
            margin: 0 0 8px 0;
            font-size: 16px;
        }

        .important-note p {
            color: #92400e;
            margin: 0;
            font-size: 14px;
        }

        .next-steps {
            background-color: #ecfdf5;
            border: 1px solid #10b981;
            border-radius: 6px;
            padding: 20px;
            margin: 25px 0;
        }

        .next-steps h4 {
            color: #047857;
            margin: 0 0 12px 0;
            font-size: 16px;
        }

        .next-steps ul {
            color: #047857;
            margin: 0;
            padding-left: 20px;
        }

        .next-steps li {
            margin-bottom: 8px;
            font-size: 14px;
        }

        .contact-info {
            background-color: #f3f4f6;
            border-radius: 6px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }

        .contact-info h4 {
            color: #1f2937;
            margin: 0 0 10px 0;
            font-size: 16px;
        }

        .contact-info p {
            color: #6b7280;
            margin: 5px 0;
            font-size: 14px;
        }

        .footer {
            background-color: #f9fafb;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }

        .footer p {
            color: #6b7280;
            margin: 0;
            font-size: 12px;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .content {
                padding: 20px;
            }

            .detail-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .detail-value {
                margin-top: 5px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">
                <img src="{{ asset('storage/nstu_logo.png') }}" alt="NSTU Logo" />
            </div>
            <h1>Seat Assignment Confirmation</h1>
            <p>NSTU Hall Management System</p>
        </div>

        <div class="content">
            <div class="greeting">
                Dear {{ $studentName }},
            </div>

            <div class="message">
                Congratulations! We are pleased to inform you that your seat assignment has been confirmed. Your
                application has been processed and you have been allocated a seat in our residential facility.
            </div>

            <div class="seat-details">
                <h3>📍 Your Seat Assignment Details</h3>
                <div class="detail-row">
                    <span class="detail-label">Room Number:</span>
                    <span class="detail-value">{{ $roomNumber }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Bed Number:</span>
                    <span class="detail-value">{{ $bedNumber }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Floor:</span>
                    <span class="detail-value">{{ $floor }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Block:</span>
                    <span class="detail-value">{{ $block }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Assignment Date:</span>
                    <span class="detail-value">{{ $startDate }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Allotment ID:</span>
                    <span class="detail-value">#{{ $allotmentId }}</span>
                </div>
            </div>

            <div class="important-note">
                <h4>⚠️ Important Information</h4>
                <p>Please keep this email for your records. You will need your Allotment ID for any future
                    correspondence regarding your seat assignment.</p>
            </div>

            <div class="next-steps">
                <h4>📋 Next Steps</h4>
                <ul>
                    <li>Report to the hall administration office within 7 days to complete your check-in process</li>
                    <li>Bring a copy of this email and your student ID for verification</li>
                    <li>Complete any required documentation and fee payments</li>
                    <li>Collect your room key and hall handbook</li>
                    <li>Familiarize yourself with hall rules and regulations</li>
                </ul>
            </div>

            <div class="contact-info">
                <h4>📞 Need Help?</h4>
                <p>If you have any questions or concerns about your seat assignment,</p>
                <p>please contact the Hall Administration Office.</p>
                <p><strong>Office Hours:</strong> Monday - Friday, 9:00 AM - 5:00 PM</p>
            </div>

            <div class="message">
                We look forward to welcoming you to our residential community. Thank you for choosing our hall
                accommodation.
            </div>

            <div class="message">
                Best regards,<br>
                <strong>Hall Management Team</strong><br>
                Hall Administration Office
            </div>
        </div>

        <div class="footer">
            <p>This is an automated message from the Hall Management System. Please do not reply to this email.</p>
            <p>© {{ date('Y') }} Hall Management System. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
