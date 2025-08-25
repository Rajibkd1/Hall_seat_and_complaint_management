<!DOCTYPE html>
<html>

<head>
    <title>Approved Applications Report</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @page {
            margin: 12mm;
            size: A4;
        }

        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            margin: 0;
            padding: 0;
            color: #1a1a1a;
            line-height: 1.4;
            font-size: 10px;
            background: #ffffff;
        }

        /* Professional Letterhead */
        .letterhead {
            text-align: center;
            border-bottom: 4px solid #2c3e50;
            padding: 20px;
            margin-bottom: 25px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px 8px 0 0;
        }

        .university-seal {
            width: 70px;
            height: 70px;
            border: 3px solid #2c3e50;
            border-radius: 50%;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            color: #2c3e50;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .university-seal img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .letterhead h1 {
            font-size: 20px;
            font-weight: bold;
            margin: 6px 0;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #2c3e50;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .letterhead .university {
            font-size: 16px;
            font-weight: bold;
            margin: 6px 0;
            color: #34495e;
        }

        .letterhead .department {
            font-size: 13px;
            margin: 4px 0;
            font-style: italic;
            color: #5d6d7e;
        }

        /* Enhanced Document Title */
        .document-title {
            text-align: center;
            margin: 25px 0;
            padding: 18px;
            border: 3px solid #2c3e50;
            background: linear-gradient(135deg, #ecf0f1 0%, #bdc3c7 100%);
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .document-title h2 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #2c3e50;
        }

        .document-title .subtitle {
            font-size: 12px;
            margin: 6px 0 0 0;
            font-weight: normal;
            color: #34495e;
        }

        /* Report Info */
        .report-info {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .report-info .left,
        .report-info .right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding: 10px;
            border: 2px solid #34495e;
            font-size: 10px;
            background: #f8f9fa;
        }

        .report-info .label {
            font-weight: bold;
            margin-bottom: 4px;
            color: #2c3e50;
        }

        /* Professional Table */
        .applications-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .applications-table th {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: #ffffff;
            padding: 12px 8px;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            border-bottom: 2px solid #1a252f;
        }

        .applications-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #bdc3c7;
            font-size: 9px;
            vertical-align: middle;
            background: #ffffff;
        }

        .applications-table tr:nth-child(even) td {
            background: #f8f9fa;
        }

        .applications-table tr:hover td {
            background: #e3f2fd;
        }

        /* Profile Picture Styling */
        .profile-picture {
            width: 40px;
            height: 50px;
            border: 2px solid #2c3e50;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            margin: 0 auto;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-picture img {
            width: 36px;
            height: 46px;
            object-fit: cover;
            border-radius: 2px;
        }

        .profile-placeholder {
            font-size: 7px;
            text-align: center;
            color: #7f8c8d;
            font-style: italic;
            line-height: 1.2;
            padding: 2px;
        }

        /* Department styling */
        .department-short {
            font-weight: bold;
            color: #2c3e50;
            background: #ecf0f1;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
        }

        /* Status styling */
        .status-approved {
            background: #d4edda;
            color: #155724;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 8px;
            text-transform: uppercase;
        }

        /* Summary Box */
        .summary-box {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 2px solid #2c3e50;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .summary-box h3 {
            font-size: 14px;
            font-weight: bold;
            margin: 0 0 10px 0;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .summary-stats {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }

        .summary-stats .stat {
            display: table-cell;
            width: 33.33%;
            text-align: center;
            padding: 8px;
            border-right: 1px solid #bdc3c7;
        }

        .summary-stats .stat:last-child {
            border-right: none;
        }

        .summary-stats .stat-number {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            display: block;
        }

        .summary-stats .stat-label {
            font-size: 9px;
            color: #7f8c8d;
            text-transform: uppercase;
            margin-top: 2px;
        }

        /* Professional Footer */
        .footer {
            margin-top: 30px;
            padding: 15px;
            border-top: 2px solid #2c3e50;
            text-align: center;
            font-size: 8px;
            color: #7f8c8d;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px;
        }

        .page-break {
            page-break-before: always;
        }

        /* Responsive adjustments for PDF */
        @media print {
            .applications-table {
                font-size: 8px;
            }

            .applications-table th,
            .applications-table td {
                padding: 6px 4px;
            }
        }
    </style>
</head>

<body>
    <!-- Letterhead -->
    <div class="letterhead">
        <div class="university-seal" @if(file_exists(storage_path('app/public/nstu_logo.png'))) style="border: none; background: transparent; box-shadow: none;" @endif>
            @php
                $logoPath = storage_path('app/public/nstu_logo.png');
            @endphp
            @if(file_exists($logoPath))
                @php
                    $logoData = file_get_contents($logoPath);
                    $logoBase64 = base64_encode($logoData);
                @endphp
                <img src="data:image/png;base64,{{ $logoBase64 }}" alt="NSTU Logo">
            @else
                <div style="font-weight: bold; font-size: 16px; color: #2c3e50;">NSTU</div>
            @endif
        </div>
        <div class="university">Noakhali Science and Technology University</div>
        <h1>Student Affairs & Residential Services</h1>
        <div class="department">Office of Hall Administration</div>
    </div>

    <!-- Document Title -->
    <div class="document-title">
        <h2>Approved Applications Report</h2>
        <div class="subtitle">Academic Session {{ date('Y') }}-{{ date('Y') + 1 }}</div>
    </div>

    <!-- Report Information -->
    <div class="report-info">
        <div class="left">
            <div class="label">Report Generated:</div>
            <div>{{ now()->format('d F Y, H:i') }}</div>
            <div class="label" style="margin-top: 8px;">Total Applications:</div>
            <div>{{ $approvedApplications->count() }}</div>
        </div>
        <div class="right">
            <div class="label">Report Type:</div>
            <div>Approved Applications Only</div>
            <div class="label" style="margin-top: 8px;">Status Filter:</div>
            <div>APPROVED</div>
        </div>
    </div>

    <!-- Summary Statistics -->
    <div class="summary-box">
        <h3>Summary Statistics</h3>
        <div class="summary-stats">
            <div class="stat">
                <span class="stat-number">{{ $approvedApplications->count() }}</span>
                <span class="stat-label">Total Approved</span>
            </div>
            <div class="stat">
                <span class="stat-number">{{ $approvedApplications->unique('department')->count() }}</span>
                <span class="stat-label">Departments</span>
            </div>
            <div class="stat">
                <span class="stat-number">{{ $approvedApplications->where('program', 'undergraduate')->count() }}</span>
                <span class="stat-label">Undergraduate</span>
            </div>
        </div>
    </div>

    <!-- Applications Table -->
    <table class="applications-table">
        <thead>
            <tr>
                <th style="width: 6%;">Photo</th>
                <th style="width: 7%;">App ID</th>
                <th style="width: 18%;">Student Name</th>
                <th style="width: 10%;">University ID</th>
                <th style="width: 13%;">Department</th>
                <th style="width: 8%;">Year</th>
                <th style="width: 12%;">Application Date</th>
                <th style="width: 12%;">Submission Date</th>
                <th style="width: 14%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($approvedApplications as $application)
                <tr>
                    <td style="text-align: center;">
                        <div class="profile-picture">
                            @if ($application->student && $application->student->profile_image)
                                @php
                                    $imagePath = public_path('storage/' . $application->student->profile_image);
                                @endphp
                                @if (file_exists($imagePath))
                                    @php
                                        $imageData = file_get_contents($imagePath);
                                        $imageBase64 = base64_encode($imageData);
                                        $imageMimeType = mime_content_type($imagePath);
                                    @endphp
                                    <img src="data:{{ $imageMimeType }};base64,{{ $imageBase64 }}" alt="Student Photo">
                                @else
                                    <div class="profile-placeholder">
                                        <div style="font-weight: bold;">PHOTO</div>
                                        <div>Not Found</div>
                                    </div>
                                @endif
                            @else
                                <div class="profile-placeholder">
                                    <div style="font-weight: bold;">PHOTO</div>
                                    <div>Not Available</div>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td style="text-align: center; font-weight: bold;">#{{ $application->application_id }}</td>
                    <td style="font-weight: bold;">{{ $application->student_name }}</td>
                    <td style="text-align: center;">{{ $application->student->university_id ?? 'N/A' }}</td>
                    <td>
                        @php
                            // Shorten department name using same logic as individual PDF
                            $dept = $application->department;
                            $abbreviations = [
                                'Computer Science and Engineering' => 'CSE',
                                'Electrical and Electronic Engineering' => 'EEE',
                                'Civil Engineering' => 'CE',
                                'Mechanical Engineering' => 'ME',
                                'Business Administration' => 'BBA',
                                'Economics' => 'ECON',
                                'Mathematics' => 'MATH',
                                'Physics' => 'PHY',
                                'Chemistry' => 'CHEM',
                                'English' => 'ENG',
                            ];
                            $words = explode(' ', $dept);
                            if (count($words) > 3) {
                                $shortDept = implode(' ', array_slice($words, 0, 3));
                            } else {
                                $shortDept = $dept;
                            }
                            $displayDept = $abbreviations[$dept] ?? $shortDept;
                        @endphp
                        <span class="department-short">{{ $displayDept }}</span>
                    </td>
                    <td style="text-align: center;">{{ $application->academic_year }}</td>
                    <td style="text-align: center;">{{ $application->application_date->format('d M Y') }}</td>
                    <td style="text-align: center;">{{ $application->submission_date->format('d M Y') }}</td>
                    <td style="text-align: center;">
                        <span class="status-approved">{{ strtoupper($application->status) }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($approvedApplications->isEmpty())
        <div style="text-align: center; padding: 40px; color: #7f8c8d; font-style: italic;">
            <h3>No Approved Applications Found</h3>
            <p>There are currently no approved applications to display in this report.</p>
        </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <strong>CONFIDENTIAL DOCUMENT - FOR ADMINISTRATIVE USE ONLY</strong><br>
        This report contains {{ $approvedApplications->count() }} approved applications | Generated:
        {{ now()->format('d M Y, H:i') }}<br>
        <em>Note: CGPA information has been excluded from this report as per administrative policy</em>
    </div>
</body>

</html>
