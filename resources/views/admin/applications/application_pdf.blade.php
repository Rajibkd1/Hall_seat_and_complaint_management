<!DOCTYPE html>
<html>

<head>
    <title>Hall Seat Application - {{ $application->student_name }}</title>
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
            line-height: 1.5;
            font-size: 11px;
            background: #ffffff;
        }

        /* Professional Letterhead */
        .letterhead {
            text-align: center;
            border-bottom: 4px solid #2c3e50;
            padding-bottom: 20px;
            margin-bottom: 25px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 20px;
            border-radius: 8px 8px 0 0;
        }

        .university-seal {
            width: 90px;
            height: 90px;
            border: 4px solid #2c3e50;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            color: #2c3e50;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .letterhead h1 {
            font-size: 22px;
            font-weight: bold;
            margin: 8px 0;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #2c3e50;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .letterhead .university {
            font-size: 18px;
            font-weight: bold;
            margin: 8px 0;
            color: #34495e;
        }

        .letterhead .department {
            font-size: 15px;
            margin: 5px 0;
            font-style: italic;
            color: #5d6d7e;
        }

        .letterhead .address {
            font-size: 10px;
            margin: 12px 0 8px 0;
            color: #7f8c8d;
            line-height: 1.4;
        }

        /* Enhanced Document Title */
        .document-title {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            border: 3px solid #2c3e50;
            background: linear-gradient(135deg, #ecf0f1 0%, #bdc3c7 100%);
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .document-title h2 {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #2c3e50;
        }

        .document-title .subtitle {
            font-size: 14px;
            margin: 8px 0 0 0;
            font-weight: normal;
            color: #34495e;
        }

        /* Professional Reference Info */
        .reference-info {
            display: table;
            width: 100%;
            margin-bottom: 25px;
            border-collapse: collapse;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .reference-info .left,
        .reference-info .right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding: 12px;
            border: 2px solid #34495e;
            font-size: 11px;
            background: #f8f9fa;
        }

        .reference-info .label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #2c3e50;
        }

        /* Enhanced Student Header */
        .student-header {
            display: table;
            width: 100%;
            margin-bottom: 25px;
            border: 3px solid #2c3e50;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .photo-section {
            display: table-cell;
            width: 130px;
            padding: 20px;
            text-align: center;
            vertical-align: top;
            border-right: 2px solid #34495e;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .student-photo {
            width: 110px;
            height: 130px;
            border: 3px solid #2c3e50;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .student-photo img {
            width: 104px;
            height: 124px;
            object-fit: cover;
            border-radius: 2px;
        }

        .photo-placeholder {
            font-size: 9px;
            text-align: center;
            color: #7f8c8d;
            font-style: italic;
            line-height: 1.3;
        }

        .student-details {
            display: table-cell;
            padding: 20px;
            vertical-align: top;
            background: #ffffff;
        }

        .student-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            text-transform: uppercase;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 8px;
            color: #2c3e50;
            letter-spacing: 1px;
        }

        .basic-info {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }

        .basic-info .row {
            display: table-row;
        }

        .basic-info .label,
        .basic-info .value {
            display: table-cell;
            padding: 8px 12px;
            border: 1px solid #bdc3c7;
            font-size: 11px;
        }

        .basic-info .label {
            width: 40%;
            font-weight: bold;
            background: linear-gradient(135deg, #ecf0f1 0%, #d5dbdb 100%);
            color: #2c3e50;
        }

        .basic-info .value {
            background: #ffffff;
            color: #34495e;
        }

        /* Professional Sections */
        .section {
            margin-bottom: 25px;
            border: 2px solid #34495e;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .section-header {
            background: #2c3e50;
            color: #ffffff;
            padding: 15px 20px;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            border-bottom: 3px solid #1a252f;
            border-left: 5px solid #e74c3c;
            margin: 0;
            display: block;
        }

        .section-content {
            padding: 16px;
            background: #ffffff;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        .info-table td {
            padding: 10px 12px;
            border: 1px solid #bdc3c7;
            font-size: 11px;
            vertical-align: top;
        }

        .info-table .field-label {
            width: 35%;
            font-weight: bold;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: #2c3e50;
        }

        .info-table .field-value {
            width: 65%;
            background: #ffffff;
            color: #34495e;
        }

        .two-column {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }

        .two-column .col {
            display: table-cell;
            width: 50%;
            padding: 0 8px;
            vertical-align: top;
        }

        /* Enhanced Status Box */
        .status-box {
            text-align: center;
            padding: 15px;
            border: 3px solid #2c3e50;
            margin: 20px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .status-label {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 8px;
            color: #2c3e50;
        }

        .status-value {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 8px 16px;
            border: 2px solid #2c3e50;
            display: inline-block;
            border-radius: 5px;
            letter-spacing: 1px;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
            border-color: #856404;
        }

        .status-approved {
            background: #d4edda;
            color: #155724;
            border-color: #155724;
        }

        .status-rejected {
            background: #f8d7da;
            color: #721c24;
            border-color: #721c24;
        }

        .status-verified {
            background: #d1ecf1;
            color: #0c5460;
            border-color: #0c5460;
        }

        /* Professional Declarations */
        .declarations {
            border: 3px solid #2c3e50;
            padding: 20px;
            margin: 25px 0;
            border-radius: 8px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .declarations h3 {
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            margin: 0 0 20px 0;
            text-transform: uppercase;
            color: #2c3e50;
            letter-spacing: 1px;
        }

        .declarations ol {
            margin: 0;
            padding-left: 25px;
        }

        .declarations li {
            margin-bottom: 12px;
            font-size: 11px;
            line-height: 1.6;
            color: #34495e;
        }

        /* Enhanced Signature Section */
        .signature-section {
            margin-top: 35px;
            display: table;
            width: 100%;
        }

        .signature-box {
            display: table-cell;
            width: 100%;
            padding: 25px;
            text-align: center;
            border: 2px solid #2c3e50;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 8px;
        }

        .signature-line {
            border-bottom: 2px solid #2c3e50;
            height: 50px;
            margin-bottom: 12px;
        }

        .signature-label {
            font-size: 12px;
            font-weight: bold;
            color: #2c3e50;
        }

        /* Professional Footer */
        .footer {
            margin-top: 35px;
            padding-top: 20px;
            border-top: 2px solid #2c3e50;
            text-align: center;
            font-size: 9px;
            color: #7f8c8d;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 15px;
            border-radius: 8px;
        }

        .page-break {
            page-break-before: always;
        }

        .empty-value {
            color: #95a5a6;
            font-style: italic;
        }

        /* Department name shortening */
        .department-short {
            font-weight: bold;
            color: #2c3e50;
        }
    </style>
</head>

<body>
    <!-- Letterhead -->
    <div class="letterhead">
        <div class="university-seal">NSTU</div>
        <div class="university">Noakhali Science and Technology University</div>
        <h1>Student Affairs & Residential Services</h1>
        <div class="department">Office of Hall Administration</div>
        <div class="address">University Campus, Academic Block, City - 12345 | Phone: +1-234-567-8900 | Email:
            halls@university.edu</div>
    </div>

    <!-- Document Title -->
    <div class="document-title">
        <h2>Hall Seat Application Form</h2>
        <div class="subtitle">Academic Session {{ date('Y') }}-{{ date('Y') + 1 }}</div>
    </div>

    <!-- Reference Information -->
    <div class="reference-info">
        <div class="left">
            <div class="label">Application Reference No.:</div>
            <div>#{{ $application->application_id }}</div>
            <div class="label" style="margin-top: 8px;">Date of Application:</div>
            <div>{{ $application->application_date->format('d F Y') }}</div>
        </div>
        <div class="right">
            <div class="label">Date of Submission:</div>
            <div>{{ $application->submission_date->format('d F Y, H:i') }}</div>
            <div class="label" style="margin-top: 8px;">Document Generated:</div>
            <div>{{ now()->format('d F Y, H:i') }}</div>
        </div>
    </div>

    <!-- Student Header Section -->
    <div class="student-header">
        <div class="photo-section">
            <div class="student-photo">
                @if ($student->profile_image)
                    @php
                        $imagePath = public_path('storage/' . $student->profile_image);
                    @endphp
                    @if (file_exists($imagePath))
                        @php
                            $imageData = file_get_contents($imagePath);
                            $imageBase64 = base64_encode($imageData);
                            $imageMimeType = mime_content_type($imagePath);
                        @endphp
                        <img src="data:{{ $imageMimeType }};base64,{{ $imageBase64 }}" alt="Student Photo"
                            style="width: 96px; height: 116px; object-fit: cover;">
                    @else
                        <div class="photo-placeholder">
                            <div style="font-weight: bold; font-size: 10px;">STUDENT PHOTOGRAPH</div>
                            <div style="margin-top: 8px; font-size: 9px; line-height: 1.2;">
                                {{ $application->student_name }}</div>
                            <div style="margin-top: 5px; font-size: 8px;">ID: {{ $student->university_id }}</div>
                            <div style="margin-top: 5px; font-size: 7px; color: #999;">(Image not found)</div>
                        </div>
                    @endif
                @else
                    <div class="photo-placeholder">
                        <div style="font-weight: bold; font-size: 10px;">STUDENT PHOTOGRAPH</div>
                        <div style="margin-top: 8px; font-size: 9px; line-height: 1.2;">
                            {{ $application->student_name }}</div>
                        <div style="margin-top: 5px; font-size: 8px;">ID: {{ $student->university_id }}</div>
                        <div style="margin-top: 5px; font-size: 7px; color: #999;">(Not Provided)</div>
                    </div>
                @endif
            </div>
            <div style="font-size: 9px; font-weight: bold;">AFFIX RECENT<br>PHOTOGRAPH</div>
        </div>
        <div class="student-details">
            <div class="student-name">{{ $application->student_name }}</div>
            <div class="basic-info">
                <div class="row">
                    <div class="label">University ID:</div>
                    <div class="value">{{ $student->university_id }}</div>
                </div>
                <div class="row">
                    <div class="label">Department:</div>
                    <div class="value">
                        @php
                            // Shorten department name to first 3 words or create abbreviation
                            $dept = $application->department;
                            $words = explode(' ', $dept);
                            if (count($words) > 3) {
                                $shortDept = implode(' ', array_slice($words, 0, 3));
                            } else {
                                $shortDept = $dept;
                            }
                            // Common department abbreviations
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
                            $displayDept = $abbreviations[$dept] ?? $shortDept;
                        @endphp
                        <span class="department-short">{{ $displayDept }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="label">Academic Year:</div>
                    <div class="value">{{ $application->academic_year }}</div>
                </div>
                <div class="row">
                    <div class="label">Email Address:</div>
                    <div class="value">{{ $student->email }}</div>
                </div>
                <div class="row">
                    <div class="label">Contact Number:</div>
                    <div class="value">{{ $student->phone ?? 'Not Provided' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Application Status -->
    <div class="status-box">
        <div class="status-label">Current Application Status</div>
        <div class="status-value status-{{ $application->status }}">{{ strtoupper($application->status) }}</div>
    </div>

    <!-- Guardian Information -->
    <div class="section">
        <div class="section-header">Guardian/Parent Information</div>
        <div class="section-content">
            <table class="info-table">
                <tr>
                    <td class="field-label">Guardian Name:</td>
                    <td class="field-value">{{ $application->guardian_name }}</td>
                </tr>
                <tr>
                    <td class="field-label">Contact Number:</td>
                    <td class="field-value">{{ $application->guardian_mobile }}</td>
                </tr>
                <tr>
                    <td class="field-label">Relationship:</td>
                    <td class="field-value">{{ ucfirst($application->guardian_relationship) }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Academic Information -->
    <div class="section">
        <div class="section-header">Academic Information</div>
        <div class="section-content">
            <table class="info-table">
                <tr>
                    <td class="field-label">Program:</td>
                    <td class="field-value">{{ ucfirst($application->program) }}</td>
                </tr>
                <tr>
                    <td class="field-label">Current Year:</td>
                    <td class="field-value">{{ $application->semester_year ?? 'Not Specified' }}</td>
                </tr>
                <tr>
                    <td class="field-label">Term:</td>
                    <td class="field-value">{{ $application->semester_term ?? 'Not Specified' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Personal Information -->
    <div class="section">
        <div class="section-header">Personal Information</div>
        <div class="section-content">
            <table class="info-table">
                <tr>
                    <td class="field-label">Physical Condition:</td>
                    <td class="field-value">{{ ucfirst($application->physical_condition) }}</td>
                </tr>
                <tr>
                    <td class="field-label">Family Status:</td>
                    <td class="field-value">{{ str_replace('-', ' ', ucfirst($application->family_status)) }}</td>
                </tr>
                <tr>
                    <td class="field-label">Permanent Address:</td>
                    <td class="field-value">{{ $application->permanent_address ?? 'Not Provided' }}</td>
                </tr>
                <tr>
                    <td class="field-label">Current Address:</td>
                    <td class="field-value">{{ $application->current_address ?? 'Not Provided' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="section">
        <div class="section-header">Additional Information</div>
        <div class="section-content">
            <table class="info-table">
                <tr>
                    <td class="field-label">Co-curricular Activities:</td>
                    <td class="field-value">
                        @php
                            $activities = json_decode($application->activities, true) ?? [];
                            echo !empty($activities) ? implode(', ', array_map('ucfirst', $activities)) : 'None';
                        @endphp
                    </td>
                </tr>
                <tr>
                    <td class="field-label">Other Information:</td>
                    <td class="field-value">
                        @php
                            $otherInfo = json_decode($application->other_info, true) ?? [];
                            echo !empty($otherInfo) ? implode(', ', array_map('ucfirst', $otherInfo)) : 'None';
                        @endphp
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Declarations -->
    <div class="declarations">
        <h3>Student Declarations</h3>
        <ol>
            <li>I hereby declare that all the information provided in this application form is true, complete, and
                accurate to the best of my knowledge and belief.</li>
            <li>I agree to occupy any type of seat (single/double/triple occupancy) that may be allocated to me by the
                Hall Administration.</li>
            <li>I understand and agree to abide by all the rules, regulations, and policies of the residential hall as
                prescribed by the University.</li>
            <li>I acknowledge that my application will be automatically cancelled if I fail to occupy the allocated seat
                within seven (7) days of the allocation notification.</li>
            <li>I understand that providing false or misleading information may result in the rejection of my
                application and/or disciplinary action.</li>
        </ol>
    </div>

    <!-- Signature Section -->
    <div class="signature-section">
        <div class="signature-box" style="width: 100%; text-align: center;">
            <div class="signature-line"></div>
            <div class="signature-label">Student's Signature</div>
            <div style="margin-top: 5px; font-size: 10px;">Date: _______________</div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <strong>FOR OFFICE USE ONLY</strong><br>
        Application received on: ________________ | Processed by: ________________ | Remarks: ________________<br><br>
        This is a computer-generated document. Application Reference: #{{ $application->application_id }} | Generated:
        {{ now()->format('d M Y, H:i') }}
    </div>
</body>

</html>
