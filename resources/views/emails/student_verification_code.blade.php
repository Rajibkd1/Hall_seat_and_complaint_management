<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Account</title>
</head>

<body
    style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa;">
    <div
        style="max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,0.08); overflow: hidden;">

        <!-- Header -->
        <div style="background-color: #2c3e50; padding: 40px 30px; text-align: center;">
            <div
                style="width: 60px; height: 60px; background: rgba(255, 255, 255, 0.1); border-radius: 8px; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; padding: 4px;">
                <img src="{{ asset('storage/nstu_logo.png') }}" alt="NSTU Logo"
                    style="width: 100%; height: 100%; object-fit: contain; border-radius: 4px;" />
            </div>
            <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: 300; letter-spacing: 1px;">
                Account Verification
            </h1>
            <div style="width: 60px; height: 3px; background-color: #3498db; margin: 20px auto 0; border-radius: 2px;">
            </div>
        </div>

        <!-- Content -->
        <div style="padding: 50px 40px;">
            <h2 style="color: #2c3e50; font-size: 24px; margin-bottom: 25px; font-weight: 400; text-align: center;">
                Welcome! You're almost there
            </h2>

            <p style="color: #5a6c7d; font-size: 16px; line-height: 1.7; margin-bottom: 35px; text-align: center;">
                We're excited to have you on board! To complete your registration and secure your account, please use
                the verification code below.
            </p>

            <!-- Verification Code Box -->
            <div
                style="background-color: #f8f9fa; border: 2px solid #e9ecef; border-radius: 8px; padding: 30px; text-align: center; margin: 40px 0; position: relative;">
                <div
                    style="position: absolute; top: -1px; left: 50%; transform: translateX(-50%); width: 100px; height: 2px; background-color: #3498db;">
                </div>

                <p
                    style="color: #7f8c8d; font-size: 14px; margin: 0 0 15px 0; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">
                    Verification Code
                </p>

                <div
                    style="background-color: #ffffff; border: 1px solid #dee2e6; border-radius: 6px; padding: 20px; margin: 15px 0; display: inline-block;">
                    <span
                        style="color: #2c3e50; font-size: 36px; font-weight: 600; letter-spacing: 6px; font-family: 'Courier New', monospace;">
                        {{ $code }}
                    </span>
                </div>

                <p style="color: #95a5a6; font-size: 13px; margin: 15px 0 0 0; font-style: italic;">
                    This code expires in 10 minutes
                </p>
            </div>

            <p style="color: #5a6c7d; font-size: 16px; line-height: 1.7; margin-bottom: 35px; text-align: center;">
                Simply enter this code in the verification field to activate your account and start exploring all our
                features.
            </p>

            <!-- Security Notice -->
            <div
                style="background-color: #fefefe; border: 1px solid #e1e8ed; border-left: 4px solid #95a5a6; padding: 20px; margin: 30px 0; border-radius: 4px;">
                <p style="color: #5a6c7d; font-size: 14px; margin: 0; line-height: 1.6;">
                    <strong style="color: #2c3e50;">Security Notice:</strong> If you didn't request this verification
                    code, please ignore this email. Your account remains secure.
                </p>
            </div>

            <!-- Call to Action -->
            <div style="text-align: center; margin-top: 40px;">
                <div
                    style="display: inline-block; padding: 15px 30px; background-color: #3498db; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: 500; letter-spacing: 0.5px;">
                    Complete Verification
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div style="background-color: #f8f9fa; padding: 30px 40px; text-align: center; border-top: 1px solid #e9ecef;">
            <p style="color: #7f8c8d; font-size: 14px; margin: 0 0 20px 0; line-height: 1.5;">
                Thank you for choosing us! We're here to help if you need any assistance.
            </p>

            <div style="margin-top: 20px;">
                <a href="#"
                    style="color: #3498db; text-decoration: none; font-size: 14px; margin: 0 20px; font-weight: 500;">Help
                    Center</a>
                <span style="color: #bdc3c7;">|</span>
                <a href="#"
                    style="color: #3498db; text-decoration: none; font-size: 14px; margin: 0 20px; font-weight: 500;">Contact
                    Support</a>
            </div>

            <div style="margin-top: 25px; padding-top: 20px; border-top: 1px solid #e9ecef;">
                <p style="color: #95a5a6; font-size: 12px; margin: 0;">
                    This is an automated message. Please do not reply to this email.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
