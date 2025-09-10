<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $emailSubject }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="10" cy="60" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="90" cy="40" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(1deg);
            }
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header .subtitle {
            font-size: 16px;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            padding: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 8px;
        }

        .content {
            padding: 40px 30px;
            background: #ffffff;
        }

        .message-box {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-left: 4px solid #4f46e5;
            padding: 25px;
            border-radius: 12px;
            margin: 20px 0;
            position: relative;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .message-box::before {
            content: '"';
            position: absolute;
            top: -10px;
            left: 20px;
            font-size: 60px;
            color: #4f46e5;
            opacity: 0.2;
            font-family: Georgia, serif;
        }

        .message-text {
            font-size: 16px;
            line-height: 1.7;
            color: #374151;
            white-space: pre-line;
            position: relative;
            z-index: 1;
        }

        .divider {
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, #4f46e5 50%, transparent 100%);
            margin: 30px 0;
            border-radius: 1px;
        }

        .info-section {
            background: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #e5e7eb;
        }

        .info-title {
            font-size: 14px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .info-value {
            font-size: 16px;
            color: #111827;
            font-weight: 500;
        }

        .footer {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
            color: #d1d5db;
            padding: 30px;
            text-align: center;
        }

        .footer-logo {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
        }

        .footer-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 4px;
        }

        .footer h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #f9fafb;
        }

        .footer p {
            font-size: 14px;
            margin-bottom: 8px;
            opacity: 0.8;
        }

        .footer .warning {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            font-size: 13px;
        }

        .social-links {
            margin-top: 20px;
        }

        .social-links a {
            display: inline-block;
            width: 35px;
            height: 35px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            margin: 0 5px;
            text-decoration: none;
            color: #d1d5db;
            line-height: 35px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .header {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 24px;
            }

            .content {
                padding: 30px 20px;
            }

            .footer {
                padding: 25px 20px;
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
            <h1>{{ $emailSubject }}</h1>
            <div class="subtitle">NSTU Hall Management System</div>
        </div>

        <div class="content">
            <div class="info-section">
                <div class="info-title">Message from Administration</div>
                <div class="info-value">Official Communication</div>
            </div>

            <div class="divider"></div>

            <div class="message-box">
                <div class="message-text">{{ $emailMessage }}</div>
            </div>

            <div class="divider"></div>

            <div class="info-section">
                <div class="info-title">Need Help?</div>
                <div class="info-value">Contact the administration office for any queries or assistance.</div>
            </div>
        </div>

        <div class="footer">
            <div class="footer-logo">
                <img src="{{ asset('storage/nstu_logo.png') }}" alt="NSTU Logo" />
            </div>
            <h3>NSTU Hall Management</h3>
            <p>Noakhali Science and Technology University</p>
            <p>Sonapur, Noakhali-3814, Bangladesh</p>

            <div class="warning">
                <strong>⚠️ Important:</strong> This is an automated message from the NSTU Hall Management System. Please
                do not reply to this email. For any queries, contact the administration office directly.
            </div>

            <div class="social-links">
                <a href="#" title="Website">🌐</a>
                <a href="#" title="Email">📧</a>
                <a href="#" title="Phone">📞</a>
            </div>
        </div>
    </div>
</body>

</html>
