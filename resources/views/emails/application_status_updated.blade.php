<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status Update</title>
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
            max-width: 650px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
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
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            opacity: 0.3;
            animation: drift 30s linear infinite;
        }
        
        @keyframes drift {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(-20px, -20px) rotate(360deg); }
        }
        
        .header-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            backdrop-filter: blur(10px);
        }
        
        .header-icon svg {
            width: 40px;
            height: 40px;
            fill: white;
        }
        
        .header h1 {
            font-size: 32px;
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
            font-weight: 300;
        }
        
        .content {
            padding: 40px 30px;
            background: #ffffff;
        }
        
        .greeting {
            font-size: 20px;
            color: #1f2937;
            margin-bottom: 25px;
            font-weight: 600;
        }
        
        .status-announcement {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 2px solid #0ea5e9;
            border-radius: 16px;
            padding: 30px;
            margin: 25px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .status-announcement::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent 30%, rgba(14, 165, 233, 0.05) 50%, transparent 70%);
            animation: shimmer 3s ease-in-out infinite;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
        
        .status-announcement p {
            font-size: 18px;
            color: #0f172a;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }
        
        .status-badge {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .status-approved {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }
        
        .status-rejected {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }
        
        .status-pending {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }
        
        .status-waitlisted {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }
        
        .status-verified {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
        }
        
        .details-card {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 16px;
            padding: 30px;
            margin: 30px 0;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .details-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        
        .details-title::before {
            content: '📋';
            margin-right: 10px;
            font-size: 24px;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: #64748b;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .detail-value {
            font-weight: 500;
            color: #1e293b;
            font-size: 16px;
        }
        
        .message-section {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-left: 4px solid #f59e0b;
            border-radius: 12px;
            padding: 25px;
            margin: 25px 0;
            position: relative;
        }
        
        .message-section::before {
            content: '💬';
            position: absolute;
            top: -10px;
            left: 20px;
            font-size: 30px;
            background: white;
            padding: 5px;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .message-title {
            font-size: 18px;
            font-weight: 700;
            color: #92400e;
            margin-bottom: 15px;
            margin-top: 10px;
        }
        
        .message-content {
            font-size: 16px;
            line-height: 1.7;
            color: #78350f;
            white-space: pre-line;
            background: rgba(255, 255, 255, 0.7);
            padding: 15px;
            border-radius: 8px;
        }
        
        .help-section {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            border-radius: 12px;
            padding: 25px;
            margin: 25px 0;
            text-align: center;
            border: 1px solid #a7f3d0;
        }
        
        .help-section h3 {
            color: #065f46;
            font-size: 18px;
            margin-bottom: 10px;
        }
        
        .help-section p {
            color: #047857;
            font-size: 14px;
        }
        
        .footer {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
            color: #d1d5db;
            padding: 40px 30px;
            text-align: center;
        }
        
        .footer-logo {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }
        
        .footer-logo svg {
            width: 25px;
            height: 25px;
            fill: #d1d5db;
        }
        
        .footer h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #f9fafb;
        }
        
        .footer p {
            font-size: 14px;
            margin-bottom: 8px;
            opacity: 0.8;
        }
        
        .footer .disclaimer {
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 10px;
            padding: 20px;
            margin-top: 25px;
            font-size: 13px;
            line-height: 1.5;
        }
        
        .contact-info {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .contact-info a {
            color: #60a5fa;
            text-decoration: none;
        }
        
        .contact-info a:hover {
            color: #93c5fd;
        }
        
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            
            .header {
                padding: 30px 20px;
            }
            
            .header h1 {
                font-size: 26px;
            }
            
            .content {
                padding: 30px 20px;
            }
            
            .footer {
                padding: 30px 20px;
            }
            
            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="header-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1>Application Status Update</h1>
            <div class="subtitle">NSTU Hall Management System</div>
        </div>
        
        <div class="content">
            <div class="greeting">Dear {{ $application->student_name }},</div>
            
            <div class="status-announcement">
                <p>We are pleased to inform you that your seat application status has been updated.</p>
                <div class="status-badge status-{{ $application->status }}">
                    {{ ucfirst($application->status) }}
                </div>
            </div>
            
            <div class="details-card">
                <div class="details-title">Application Details</div>
                
                <div class="detail-row">
                    <span class="detail-label">Application ID</span>
                    <span class="detail-value">#{{ $application->application_id }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Student Name</span>
                    <span class="detail-value">{{ $application->student_name }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Department</span>
                    <span class="detail-value">{{ $application->department }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Academic Year</span>
                    <span class="detail-value">{{ $application->academic_year }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Application Date</span>
                    <span class="detail-value">{{ $application->application_date->format('F j, Y') }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Current Status</span>
                    <span class="detail-value status-badge status-{{ $application->status }}" style="font-size: 12px; padding: 6px 12px;">
                        {{ ucfirst($application->status) }}
                    </span>
                </div>
            </div>
            
            @if ($message)
                <div class="message-section">
                    <div class="message-title">Message from Administration</div>
                    <div class="message-content">{{ $message }}</div>
                </div>
            @endif
            
            <div class="help-section">
                <h3>🤝 Need Assistance?</h3>
                <p>If you have any questions or need further assistance regarding your application, please don't hesitate to contact the administration office.</p>
            </div>
        </div>
        
        <div class="footer">
            <div class="footer-logo">
                <svg viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg>
            </div>
            <h3>NSTU Hall Management</h3>
            <p>Noakhali Science and Technology University</p>
            <p>Sonapur, Noakhali-3814, Bangladesh</p>
            
            <div class="contact-info">
                <p>📧 Email: <a href="mailto:hall@nstu.edu.bd">hall@nstu.edu.bd</a></p>
                <p>📞 Phone: +880-321-61051-4</p>
                <p>🌐 Website: <a href="https://www.nstu.edu.bd">www.nstu.edu.bd</a></p>
            </div>
            
            <div class="disclaimer">
                <strong>📢 Important Notice:</strong> This is an automated message from the NSTU Hall Management System. Please do not reply to this email. For any queries or concerns, please contact the administration office directly using the contact information provided above.
            </div>
        </div>
    </div>
</body>
</html>
