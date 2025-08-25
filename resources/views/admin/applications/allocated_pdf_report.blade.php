<!DOCTYPE html>
<html>

<head>
    <title>Allocated Students Report - {{ now()->format('F Y') }}</title>
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
            padding-bottom: 20px;
            margin-bottom: 25px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 20px;
            border-radius: 8px 8px 0 0;
        }

        .university-seal {
            width: 80px;
            height: 80px;
            border: 4px solid #2c3e50;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            color: #2c3e50;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .university-seal img {
            width: 70px;
            height: 70px;
            object-fit: contain;
        }

        .letterhead h1 {
            font-size: 20px;
            font-weight: bold;
            margin: 8px 0;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #2c3e50;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .letterhead .university {
            font-size: 16px;
            font-weight: bold;
            margin: 8px 0;
            color: #34495e;
        }

        .letterhead .department {
            font-size: 13px;
            margin: 5px 0;
            font-style: italic;
            color: #5d6d7e;
        }

        .letterhead .address {
            font-size: 9px;
            margin: 12px 0 8px 0;
            color: #7f8c8d;
            line-height: 1.4;
        }

        /* Enhanced Document Title */
        .document-title {
            text-align: center;
            margin: 25px 0;
            padding: 15px;
            border: 3px solid #2c3e50;
            background: linear-gradient(135deg, #ecf0f1 0%, #bdc3c7 100%);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .document-title h2 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #2c3e50;
        }

        .document-title .subtitle {
            font-size: 12px;
            margin: 8px 0 0 0;
            font-weight: normal;
            color: #34495e;
        }

        /* Statistics Section */
        .statistics {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .stat-box {
            display: table-cell;
            width: 25%;
            padding: 12px;
            text-align: center;
            border: 2px solid #34495e;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .stat-number {
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 9px;
            color: #5d6d7e;
            text-transform: uppercase;
            font-weight: bold;
        }

        /* Professional Table */
        .students-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .students-table th {
            background: #2c3e50;
            color: #ffffff;
            padding: 10px 8px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 1px solid #1a252f;
            text-align: left;
        }

        .students-table td {
            padding: 8px;
            border: 1px solid #bdc3c7;
            font-size: 9px;
            vertical-align: top;
        }

        .students-table tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        .students-table tbody tr:hover {
            background: #e9ecef;
        }

        /* Student Photo */
        .student-photo {
            width: 30px;
            height: 35px;
            border: 1px solid #2c3e50;
            border-radius: 3px;
            object-fit: cover;
        }

        .photo-placeholder {
            width: 30px;
            height: 35px;
            border: 1px solid #bdc3c7;
            border-radius: 3px;
            background: #ecf0f1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8px;
            font-weight: bold;
            color: #5d6d7e;
        }

        /* Student Info */
        .student-name {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 2px;
        }

        .student-id {
            color: #5d6d7e;
            font-size: 8px;
        }

        .department-short {
            color: #7f8c8d;
            font-size: 8px;
            font-style: italic;
        }

        /* Seat Info */
        .seat-info {
            font-weight: bold;
            color: #2c3e50;
        }

        .seat-details {
            color: #5d6d7e;
            font-size: 8px;
        }

        /* Allocation Info */
        .allocation-info {
            color: #34495e;
        }

        .allocation-date {
            color: #7f8c8d;
            font-size: 8px;
        }

        /* Footer */
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #2c3e50;
            text-align: center;
            font-size: 8px;
            color: #7f8c8d;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 12px;
            border-radius: 6px;
        }

        .page-break {
            page-break-before: always;
        }

        /* Department abbreviations */
        .dept-abbr {
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
        <h2>Allocated Students Report</h2>
        <div class="subtitle">Generated on {{ now()->format('F j, Y \a\t g:i A') }}</div>
    </div>

    <!-- Statistics Section -->
    <div class="statistics">
        <div class="stat-box">
            <div class="stat-number">{{ $allocatedStudents->count() }}</div>
            <div class="stat-label">Total Allocated</div>
        </div>
        <div class="stat-box">
            <div class="stat-number">{{ $allocatedStudents->pluck('seat.room_number')->unique()->count() }}</div>
            <div class="stat-label">Occupied Rooms</div>
        </div>
        <div class="stat-box">
            <div class="stat-number">{{ $allocatedStudents->pluck('seat.block')->unique()->count() }}</div>
            <div class="stat-label">Blocks Used</div>
        </div>
        <div class="stat-box">
            <div class="stat-number">{{ $allocatedStudents->pluck('seat.floor')->unique()->count() }}</div>
            <div class="stat-label">Floors Used</div>
        </div>
    </div>

    <!-- Students Table -->
    @if ($allocatedStudents->count() > 0)
        <table class="students-table">
            <thead>
                <tr>
                    <th style="width: 8%;">Photo</th>
                    <th style="width: 22%;">Student Information</th>
                    <th style="width: 20%;">Seat Details</th>
                    <th style="width: 18%;">Allocation Info</th>
                    <th style="width: 16%;">Duration</th>
                    <th style="width: 16%;">Department</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allocatedStudents as $allotment)
                    <tr>
                        <!-- Photo Column -->
                        <td style="text-align: center;">
                            @if ($allotment->student && $allotment->student->profile_image)
                                @php
                                    $imagePath = public_path('storage/' . $allotment->student->profile_image);
                                @endphp
                                @if (file_exists($imagePath))
                                    @php
                                        $imageData = file_get_contents($imagePath);
                                        $imageBase64 = base64_encode($imageData);
                                        $imageMimeType = mime_content_type($imagePath);
                                    @endphp
                                    <img src="data:{{ $imageMimeType }};base64,{{ $imageBase64 }}" alt="Student Photo"
                                        class="student-photo">
                                @else
                                    <div class="photo-placeholder">
                                        {{ substr($allotment->student->name ?? 'N', 0, 1) }}
                                    </div>
                                @endif
                            @else
                                <div class="photo-placeholder">
                                    {{ substr($allotment->student->name ?? 'N', 0, 1) }}
                                </div>
                            @endif
                        </td>

                        <!-- Student Information -->
                        <td>
                            <div class="student-name">{{ $allotment->student->name ?? 'N/A' }}</div>
                            <div class="student-id">ID: {{ $allotment->student->university_id ?? 'N/A' }}</div>
                            <div class="student-id">{{ $allotment->student->email ?? 'N/A' }}</div>
                        </td>

                        <!-- Seat Details -->
                        <td>
                            <div class="seat-info">Room {{ $allotment->seat->room_number ?? 'N/A' }}</div>
                            <div class="seat-details">Bed {{ $allotment->seat->bed_number ?? 'N/A' }}</div>
                            <div class="seat-details">{{ $allotment->seat->block ?? 'N/A' }} Block</div>
                            <div class="seat-details">Floor {{ $allotment->seat->floor ?? 'N/A' }}</div>
                        </td>

                        <!-- Allocation Info -->
                        <td>
                            <div class="allocation-info">{{ $allotment->admin->name ?? 'N/A' }}</div>
                            <div class="allocation-date">{{ $allotment->admin->role ?? 'Admin' }}</div>
                            <div class="allocation-date">
                                {{ \Carbon\Carbon::parse($allotment->created_at)->format('M j, Y') }}
                            </div>
                        </td>

                        <!-- Duration -->
                        <td>
                            <div class="allocation-info">
                                {{ \Carbon\Carbon::parse($allotment->start_date)->format('M j, Y') }}
                            </div>
                            @if ($allotment->end_date)
                                <div class="allocation-date">
                                    End: {{ \Carbon\Carbon::parse($allotment->end_date)->format('M j, Y') }}
                                </div>
                            @else
                                <div class="allocation-date" style="color: #27ae60; font-weight: bold;">Ongoing</div>
                            @endif
                            <div class="allocation-date">
                                {{ \Carbon\Carbon::parse($allotment->start_date)->diffForHumans() }}
                            </div>
                        </td>

                        <!-- Department -->
                        <td>
                            @php
                                // Shorten department name to abbreviation
                                $dept = $allotment->application->department ?? 'N/A';
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
                                $displayDept =
                                    $abbreviations[$dept] ??
                                    (strlen($dept) > 15 ? substr($dept, 0, 15) . '...' : $dept);
                            @endphp
                            <div class="dept-abbr">{{ $displayDept }}</div>
                            <div class="allocation-date">{{ $allotment->application->academic_year ?? 'N/A' }}</div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div style="text-align: center; padding: 40px; color: #7f8c8d;">
            <h3>No Allocated Students Found</h3>
            <p>No students have been allocated seats at this time.</p>
        </div>
    @endif

    <!-- Summary Section -->
    @if ($allocatedStudents->count() > 0)
        <div
            style="margin-top: 25px; padding: 15px; border: 2px solid #34495e; background: #f8f9fa; border-radius: 6px;">
            <h3 style="margin: 0 0 10px 0; color: #2c3e50; font-size: 12px;">Summary by Block:</h3>
            <div style="display: table; width: 100%;">
                @foreach ($allocatedStudents->groupBy('seat.block') as $block => $students)
                    <div style="display: table-cell; padding: 5px 10px; text-align: center;">
                        <div style="font-weight: bold; color: #2c3e50;">{{ $block }} Block</div>
                        <div style="font-size: 8px; color: #7f8c8d;">{{ $students->count() }} students</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <strong>CONFIDENTIAL DOCUMENT</strong><br>
        This report contains sensitive student information and should be handled according to university privacy
        policies.<br><br>
        Generated: {{ now()->format('F j, Y \a\t g:i A') }} | Total Records: {{ $allocatedStudents->count() }} |
        Report ID: ALR-{{ now()->format('Ymd-His') }}
    </div>
</body>

</html>
