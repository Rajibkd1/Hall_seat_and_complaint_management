<!DOCTYPE html>
<html>

<head>
    <title>Seat Renewal Application - {{ $renewalApplication->student->name }}</title>
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
            overflow: hidden;
        }

        .university-seal img {
            width: 80px;
            height: 80px;
            object-fit: contain;
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
        <div class="university-seal"
            @if (file_exists(storage_path('app/public/nstu_logo.png'))) style="border: none; background: transparent; box-shadow: none;" @endif>
            @php
                $logoPath = storage_path('app/public/nstu_logo.png');
            @endphp
            @if (file_exists($logoPath))
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
        <div class="address">University Campus, Sonapur, Noakhali-3814, Bangladesh | Phone: +880-321-49101 | Email:
            halls@nstu.edu.bd</div>
    </div>

    <!-- Document Title -->
    <div class="document-title">
        <h2>Seat Renewal Application Form</h2>
        <div class="subtitle">Academic Session {{ date('Y') }}-{{ date('Y') + 1 }}</div>
    </div>

    <!-- Reference Information -->
    <div class="reference-info">
        <div class="left">
            <div class="label">Renewal Application Reference No.:</div>
            <div>#{{ $renewalApplication->renewal_id }}</div>
            <div class="label" style="margin-top: 8px;">Date of Submission:</div>
            <div>{{ $renewalApplication->submission_date->format('d F Y, H:i') }}</div>
        </div>
        <div class="right">
            <div class="label">Current Seat Allocation:</div>
            <div>{{ $renewalApplication->allotment->seat->floor }}F, Room
                {{ $renewalApplication->allotment->seat->room_number }}, Bed
                {{ $renewalApplication->allotment->seat->bed_number }}</div>
            <div class="label" style="margin-top: 8px;">Document Generated:</div>
            <div>{{ now()->format('d F Y, H:i') }}</div>
        </div>
    </div>

    <!-- Student Header Section -->
    <div class="student-header">
        <div class="photo-section">
            <div class="student-photo">
                @if ($renewalApplication->student->profile_image)
                    @php
                        $imagePath = public_path('storage/' . $renewalApplication->student->profile_image);
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
                                {{ $renewalApplication->student->name }}</div>
                            <div style="margin-top: 5px; font-size: 8px;">ID:
                                {{ $renewalApplication->student->university_id }}</div>
                            <div style="margin-top: 5px; font-size: 7px; color: #999;">(Image not found)</div>
                        </div>
                    @endif
                @else
                    <div class="photo-placeholder">
                        <div style="font-weight: bold; font-size: 10px;">STUDENT PHOTOGRAPH</div>
                        <div style="margin-top: 8px; font-size: 9px; line-height: 1.2;">
                            {{ $renewalApplication->student->name }}</div>
                        <div style="margin-top: 5px; font-size: 8px;">ID:
                            {{ $renewalApplication->student->university_id }}</div>
                        <div style="margin-top: 5px; font-size: 7px; color: #999;">(Not Provided)</div>
                    </div>
                @endif
            </div>
            <div style="font-size: 9px; font-weight: bold;">AFFIX RECENT<br>PHOTOGRAPH</div>
        </div>
        <div class="student-details">
            <div class="student-name">{{ $renewalApplication->student->name }}</div>
            <div class="basic-info">
                <div class="row">
                    <div class="label">University ID:</div>
                    <div class="value">{{ $renewalApplication->student->university_id }}</div>
                </div>
                <div class="row">
                    <div class="label">Department:</div>
                    <div class="value">
                        @php
                            // Shorten department name
                            $dept = $renewalApplication->student->department ?? 'N/A';
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
                    <div class="label">Session Year:</div>
                    <div class="value">{{ $renewalApplication->student->session_year ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Email Address:</div>
                    <div class="value">{{ $renewalApplication->student->email }}</div>
                </div>
                <div class="row">
                    <div class="label">Contact Number:</div>
                    <div class="value">{{ $renewalApplication->student->phone ?? 'Not Provided' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Application Status -->
    <div class="status-box">
        <div class="status-label">Current Application Status</div>
        <div class="status-value status-{{ $renewalApplication->status }}">
            {{ strtoupper($renewalApplication->status) }}</div>
    </div>

    <!-- Academic Information -->
    <div class="section">
        <div class="section-header">Academic Information</div>
        <div class="section-content">
            <table class="info-table">
                <tr>
                    <td class="field-label">Current Semesters:</td>
                    <td class="field-value">{{ $renewalApplication->current_semesters }}</td>
                </tr>
                <tr>
                    <td class="field-label">Last Semester CGPA:</td>
                    <td class="field-value">{{ $renewalApplication->last_semester_cgpa }}</td>
                </tr>
                <tr>
                    <td class="field-label">Overall CGPA:</td>
                    <td class="field-value">{{ $renewalApplication->overall_cgpa }}</td>
                </tr>
                <tr>
                    <td class="field-label">Academic Year:</td>
                    <td class="field-value">{{ $renewalApplication->academic_year }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Current Seat Information -->
    <div class="section">
        <div class="section-header">Current Seat Allocation</div>
        <div class="section-content">
            <table class="info-table">
                <tr>
                    <td class="field-label">Hall:</td>
                    <td class="field-value">{{ $renewalApplication->allotment->seat->hall_name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="field-label">Floor:</td>
                    <td class="field-value">{{ $renewalApplication->allotment->seat->floor }}F</td>
                </tr>
                <tr>
                    <td class="field-label">Room Number:</td>
                    <td class="field-value">{{ $renewalApplication->allotment->seat->room_number }}</td>
                </tr>
                <tr>
                    <td class="field-label">Bed Number:</td>
                    <td class="field-value">{{ $renewalApplication->allotment->seat->bed_number }}</td>
                </tr>
                <tr>
                    <td class="field-label">Seat Type:</td>
                    <td class="field-value">{{ ucfirst($renewalApplication->allotment->seat->seat_type) }}</td>
                </tr>
                <tr>
                    <td class="field-label">Allocation Date:</td>
                    <td class="field-value">
                        {{ \Carbon\Carbon::parse($renewalApplication->allotment->start_date)->format('d F Y') }}</td>
                </tr>
                <tr>
                    <td class="field-label">Expiry Date:</td>
                    <td class="field-value">
                        {{ \Carbon\Carbon::parse($renewalApplication->allotment->allocation_expiry_date)->format('d F Y') }}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Renewal Information -->
    <div class="section">
        <div class="section-header">Renewal Information</div>
        <div class="section-content">
            <table class="info-table">
                <tr>
                    <td class="field-label">Renewal Reason:</td>
                    <td class="field-value">{{ $renewalApplication->renewal_reason ?? 'Not Specified' }}</td>
                </tr>
                <tr>
                    <td class="field-label">Additional Information:</td>
                    <td class="field-value">{{ $renewalApplication->additional_information ?? 'None' }}</td>
                </tr>
                <tr>
                    <td class="field-label">Supporting Documents:</td>
                    <td class="field-value">
                        @if ($renewalApplication->supporting_documents)
                            @php
                                $docs = json_decode($renewalApplication->supporting_documents, true) ?? [];
                            @endphp
                            @if (!empty($docs))
                                {{ implode(', ', array_map('ucfirst', $docs)) }}
                            @else
                                None
                            @endif
                        @else
                            None
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>

    @if ($renewalApplication->admin_notes)
        <!-- Admin Notes -->
        <div class="section">
            <div class="section-header">Administrative Notes</div>
            <div class="section-content">
                <table class="info-table">
                    <tr>
                        <td class="field-label">Admin Notes:</td>
                        <td class="field-value">{{ $renewalApplication->admin_notes }}</td>
                    </tr>
                    @if ($renewalApplication->reviewer)
                        <tr>
                            <td class="field-label">Reviewed By:</td>
                            <td class="field-value">{{ $renewalApplication->reviewer->name }}</td>
                        </tr>
                    @endif
                    @if ($renewalApplication->reviewed_at)
                        <tr>
                            <td class="field-label">Reviewed On:</td>
                            <td class="field-value">
                                {{ \Carbon\Carbon::parse($renewalApplication->reviewed_at)->format('d F Y, H:i') }}
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    @endif

    <!-- Declarations -->
    <div class="declarations">
        <h3>Student Declarations</h3>
        <ol>
            <li>I hereby declare that all the information provided in this renewal application is true, complete, and
                accurate to the best of my knowledge and belief.</li>
            <li>I understand that this renewal application is subject to approval by the Hall Administration based on
                academic performance and conduct.</li>
            <li>I agree to continue abiding by all the rules, regulations, and policies of the residential hall as
                prescribed by the University.</li>
            <li>I acknowledge that my renewal application may be rejected if I fail to meet the minimum academic
                requirements or have disciplinary issues.</li>
            <li>I understand that providing false or misleading information may result in the rejection of my renewal
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
        This is a computer-generated document. Renewal Application Reference: #{{ $renewalApplication->renewal_id }} |
        Generated:
        {{ now()->format('d M Y, H:i') }}
    </div>
</body>

</html>
