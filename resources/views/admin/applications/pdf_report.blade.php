<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Applications Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0 0 10px 0;
            color: #2c5530;
        }

        .header h2 {
            font-size: 18px;
            margin: 0 0 5px 0;
            color: #666;
        }

        .header p {
            margin: 5px 0;
            color: #888;
        }

        .summary {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 25px;
            border-left: 4px solid #28a745;
        }

        .summary h3 {
            margin: 0 0 10px 0;
            color: #2c5530;
        }

        .summary-stats {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            margin: 5px;
        }

        .stat-number {
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
        }

        .stat-label {
            font-size: 11px;
            color: #666;
            text-transform: uppercase;
        }

        .applications-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .applications-table th,
        .applications-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        .applications-table th {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
        }

        .applications-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .applications-table tr:hover {
            background-color: #e8f5e8;
        }

        .student-info {
            font-weight: bold;
        }

        .university-id {
            font-family: monospace;
            background-color: #e9ecef;
            padding: 2px 4px;
            border-radius: 3px;
        }

        .cgpa-badge {
            background-color: #007bff;
            color: white;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: bold;
        }

        .status-badge {
            background-color: #28a745;
            color: white;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        .page-break {
            page-break-after: always;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #666;
            font-style: italic;
        }

        @media print {
            body {
                margin: 0;
                padding: 15px;
            }

            .header {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <h1>Hall Seat Management System</h1>
        <h2>Approved & Verified Applications Report</h2>
        <p>Generated on: {{ now()->format('F j, Y \a\t g:i A') }}</p>
        <p>Report Period: All Time</p>
    </div>

    <!-- Summary Section -->
    <div class="summary">
        <h3>Report Summary</h3>
        <div class="summary-stats">
            <div class="stat-item">
                <div class="stat-number">{{ $approvedApplications->count() }}</div>
                <div class="stat-label">Total Approved</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $approvedApplications->where('cgpa', '>=', 3.5)->count() }}</div>
                <div class="stat-label">High CGPA (≥3.5)</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $approvedApplications->groupBy('department')->count() }}</div>
                <div class="stat-label">Departments</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">
                    {{ $approvedApplications->where('created_at', '>=', now()->subDays(30))->count() }}</div>
                <div class="stat-label">Last 30 Days</div>
            </div>
        </div>
    </div>

    @if ($approvedApplications->count() > 0)
        <!-- Applications Table -->
        <table class="applications-table">
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 20%;">Student Information</th>
                    <th style="width: 12%;">University ID</th>
                    <th style="width: 15%;">Department</th>
                    <th style="width: 10%;">Program</th>
                    <th style="width: 8%;">CGPA</th>
                    <th style="width: 15%;">Guardian Info</th>
                    <th style="width: 10%;">Application Date</th>
                    <th style="width: 5%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($approvedApplications as $index => $application)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="student-info">{{ $application->student_name }}</div>
                            @if ($application->student && $application->student->email)
                                <div style="font-size: 10px; color: #666;">{{ $application->student->email }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="university-id">{{ $application->student->university_id ?? 'N/A' }}</span>
                        </td>
                        <td>{{ $application->department }}</td>
                        <td>
                            {{ ucfirst($application->program) }}
                            @if ($application->semester_year && $application->semester_term)
                                <br><small>Y{{ $application->semester_year }}-T{{ $application->semester_term }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="cgpa-badge">{{ $application->cgpa }}</span>
                        </td>
                        <td>
                            <div style="font-size: 10px;">
                                <strong>{{ $application->guardian_name }}</strong><br>
                                {{ $application->guardian_mobile }}<br>
                                <em>{{ $application->guardian_relationship }}</em>
                            </div>
                        </td>
                        <td>{{ $application->application_date->format('M d, Y') }}</td>
                        <td>
                            <span class="status-badge">{{ $application->status }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Department-wise Breakdown -->
        @if ($approvedApplications->groupBy('department')->count() > 1)
            <div style="margin-top: 30px;">
                <h3 style="color: #2c5530; border-bottom: 1px solid #ddd; padding-bottom: 10px;">Department-wise
                    Breakdown</h3>
                <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                    <thead>
                        <tr style="background-color: #f8f9fa;">
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Department</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Count</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Percentage</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Avg CGPA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($approvedApplications->groupBy('department') as $department => $applications)
                            <tr>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $department }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                    {{ $applications->count() }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                    {{ round(($applications->count() / $approvedApplications->count()) * 100, 1) }}%
                                </td>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                    {{ round($applications->avg('cgpa'), 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @else
        <div class="no-data">
            <h3>No Approved Applications Found</h3>
            <p>There are currently no approved applications to display in this report.</p>
        </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p>This report was automatically generated by the Hall Seat Management System.</p>
        <p>For questions or concerns, please contact the system administrator.</p>
        <p style="margin-top: 10px;">
            <strong>Confidential Document</strong> - This report contains sensitive student information and should be
            handled accordingly.
        </p>
    </div>
</body>

</html>
