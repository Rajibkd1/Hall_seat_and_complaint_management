<!DOCTYPE html>
<html>

<head>
    <title>Hall Seat Application - {{ $application->student_name }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @page {
            margin: 15mm;
            size: A4;
        }

        body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            padding: 0;
            color: #000;
            line-height: 1.4;
            font-size: 12px;
        }

        .letterhead {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .university-seal {
            width: 80px;
            height: 80px;
            border: 3px solid #000;
            border-radius: 50%;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
            background: #fff;
        }

        .letterhead h1 {
            font-size: 20px;
            font-weight: bold;
            margin: 5px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .letterhead .university {
            font-size: 16px;
            font-weight: bold;
            margin: 5px 0;
        }

        .letterhead .department {
            font-size: 14px;
            margin: 3px 0;
            font-style: italic;
        }

        .letterhead .address {
            font-size: 11px;
            margin: 8px 0 5px 0;
        }

        .document-title {
            text-align: center;
            margin: 25px 0;
            padding: 15px;
            border: 2px solid #000;
            background: #f8f8f8;
        }

        .document-title h2 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .document-title .subtitle {
            font-size: 14px;
            margin: 5px 0 0 0;
            font-weight: normal;
        }

        .reference-info {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .reference-info .left,
        .reference-info .right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding: 8px;
            border: 1px solid #000;
            font-size: 11px;
        }

        .reference-info .label {
            font-weight: bold;
            margin-bottom: 3px;
        }

        .student-header {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            border: 2px solid #000;
        }

        .photo-section {
            display: table-cell;
            width: 120px;
            padding: 15px;
            text-align: center;
            vertical-align: top;
            border-right: 1px solid #000;
        }

        .student-photo {
            width: 100px;
            height: 120px;
            border: 2px solid #000;
            margin: 0 auto 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
        }

        .student-photo img {
            width: 96px;
            height: 116px;
            object-fit: cover;
        }

        .photo-placeholder {
            font-size: 10px;
            text-align: center;
            color: #666;
            font-style: italic;
        }

        .student-details {
            display: table-cell;
            padding: 15px;
            vertical-align: top;
        }

        .student-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
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
            padding: 4px 8px;
            border: 1px solid #ccc;
            font-size: 11px;
        }

        .basic-info .label {
            width: 35%;
            font-weight: bold;
            background: #f5f5f5;
        }

        .section {
            margin-bottom: 20px;
            border: 1px solid #000;
        }

        .section-header {
            background: #000;
            color: #fff;
            padding: 8px 12px;
            font-weight: bold;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .section-content {
            padding: 12px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .info-table td {
            padding: 6px 8px;
            border: 1px solid #ddd;
            font-size: 11px;
            vertical-align: top;
        }

        .info-table .field-label {
            width: 30%;
            font-weight: bold;
            background: #f9f9f9;
        }

        .info-table .field-value {
            width: 70%;
        }

        .two-column {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }

        .two-column .col {
            display: table-cell;
            width: 50%;
            padding: 0 5px;
            vertical-align: top;
        }

        .status-box {
            text-align: center;
            padding: 8px;
            border: 2px solid #000;
            margin: 15px 0;
            background: #f8f8f8;
        }

        .status-label {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .status-value {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 5px 10px;
            border: 1px solid #000;
            display: inline-block;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background: #f8d7da;
            color: #721c24;
        }

        .status-verified {
            background: #d1ecf1;
            color: #0c5460;
        }

        .declarations {
            border: 2px solid #000;
            padding: 15px;
            margin: 20px 0;
        }

        .declarations h3 {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin: 0 0 15px 0;
            text-transform: uppercase;
        }

        .declarations ol {
            margin: 0;
            padding-left: 20px;
        }

        .declarations li {
            margin-bottom: 8px;
            font-size: 11px;
            line-height: 1.4;
        }

        .signature-section {
            margin-top: 30px;
            display: table;
            width: 100%;
        }

        .signature-box {
            display: table-cell;
            width: 50%;
            padding: 20px;
            text-align: center;
            border: 1px solid #000;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            height: 40px;
            margin-bottom: 8px;
        }

        .signature-label {
            font-size: 11px;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #000;
            text-align: center;
            font-size: 10px;
        }

        .page-break {
            page-break-before: always;
        }

        .empty-value {
            color: #999;
            font-style: italic;
        }
    </style>
</head>

<body>
    <!-- Letterhead -->
    <div class="letterhead">
        <div class="university-seal">SEAL</div>
        <div class="university">UNIVERSITY NAME</div>
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
                @if ($student->profile_image && file_exists(public_path('storage/' . $student->profile_image)))
                    <img src="{{ public_path('storage/' . $student->profile_image) }}" alt="Student Photo">
                @else
                    <div class="photo-placeholder">
                        <div style="font-weight: bold;">PHOTOGRAPH</div>
                        <div style="margin-top: 5px;">{{ $application->student_name }}</div>
                        <div style="margin-top: 3px;">ID: {{ $student->university_id }}</div>
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
                    <div class="value">{{ $application->department }}</div>
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
            <div class="two-column">
                <div class="col">
                    <table class="info-table">
                        <tr>
                            <td class="field-label">Program:</td>
                            <td class="field-value">{{ ucfirst($application->program) }}</td>
                        </tr>
                        <tr>
                            <td class="field-label">Current Year:</td>
                            <td class="field-value">{{ $application->semester_year ?? 'Not Specified' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col">
                    <table class="info-table">
                        <tr>
                            <td class="field-label">Term:</td>
                            <td class="field-value">{{ $application->semester_term ?? 'Not Specified' }}</td>
                        </tr>
                        <tr>
                            <td class="field-label">CGPA:</td>
                            <td class="field-value">{{ $application->cgpa }}</td>
                        </tr>
                    </table>
                </div>
            </div>
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
                    <td class="field-label">Division:</td>
                    <td class="field-value">{{ ucfirst($application->division ?? 'Not Provided') }}</td>
                </tr>
                <tr>
                    <td class="field-label">District:</td>
                    <td class="field-value">
                        {{ ucfirst(str_replace('_', ' ', $application->district ?? 'Not Provided')) }}</td>
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
        <div class="signature-box">
            <div class="signature-line"></div>
            <div class="signature-label">Student's Signature</div>
            <div style="margin-top: 5px; font-size: 10px;">Date: _______________</div>
        </div>
        <div class="signature-box">
            <div class="signature-line"></div>
            <div class="signature-label">Guardian's Signature</div>
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
