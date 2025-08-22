<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allocated Students Report</title>
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
            color: #333;
        }
        
        .header p {
            margin: 5px 0;
            color: #666;
        }
        
        .summary {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }
        
        .summary h3 {
            margin: 0 0 10px 0;
            font-size: 16px;
            color: #333;
        }
        
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }
        
        .summary-item {
            text-align: center;
        }
        
        .summary-item .number {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
            display: block;
        }
        
        .summary-item .label {
            font-size: 11px;
            color: #666;
            margin-top: 5px;
        }
        
        .table-container {
            margin-top: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
            color: #495057;
        }
        
        td {
            font-size: 11px;
        }
        
        .student-info {
            font-weight: bold;
        }
        
        .student-id {
            color: #007bff;
            font-family: monospace;
        }
        
        .seat-info {
            background-color: #e3f2fd;
        }
        
        .status-active {
            background-color: #d4edda;
            color: #155724;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        @media print {
            body {
                margin: 0;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Allocated Students Report</h1>
        <p><strong>Generated on:</strong> {{ date('F j, Y \a\t g:i A') }}</p>
        <p><strong>Total Records:</strong> {{ $allocatedStudents->count() }}</p>
    </div>

    <div class="summary">
        <h3>Summary Statistics</h3>
        <div class="summary-grid">
            <div class="summary-item">
                <span class="number">{{ $allocatedStudents->count() }}</span>
                <div class="label">Total Allocated Students</div>
            </div>
            <div class="summary-item">
                <span class="number">{{ $allocatedStudents->pluck('seat.room_number')->unique()->count() }}</span>
                <div class="label">Occupied Rooms</div>
            </div>
            <div class="summary-item">
                <span class="number">{{ $allocatedStudents->pluck('seat.block')->unique()->count() }}</span>
                <div class="label">Blocks Used</div>
            </div>
            <div class="summary-item">
                <span class="number">{{ $allocatedStudents->pluck('seat.floor')->unique()->count() }}</span>
                <div class="label">Floors Used</div>
            </div>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 20%;">Student Information</th>
                    <th style="width: 15%;">Seat Details</th>
                    <th style="width: 15%;">Academic Info</th>
                    <th style="width: 15%;">Allocation Details</th>
                    <th style="width: 15%;">Duration</th>
                    <th style="width: 10%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allocatedStudents as $index => $allotment)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="student-info">{{ $allotment->student->name ?? 'N/A' }}</div>
                            <div class="student-id">ID: {{ $allotment->student->university_id ?? 'N/A' }}</div>
                            <div style="font-size: 10px; color: #666;">{{ $allotment->student->email ?? 'No email' }}</div>
                        </td>
                        <td class="seat-info">
                            <div><strong>Room:</strong> {{ $allotment->seat->room_number ?? 'N/A' }}</div>
                            <div><strong>Bed:</strong> {{ $allotment->seat->bed_number ?? 'N/A' }}</div>
                            <div><strong>Block:</strong> {{ $allotment->seat->block ?? 'N/A' }}</div>
                            <div><strong>Floor:</strong> {{ $allotment->seat->floor ?? 'N/A' }}</div>
                        </td>
                        <td>
                            <div><strong>Dept:</strong> {{ $allotment->application->department ?? 'N/A' }}</div>
                            <div><strong>Program:</strong> {{ ucfirst($allotment->application->program ?? 'N/A') }}</div>
                            <div><strong>CGPA:</strong> {{ $allotment->application->cgpa ?? 'N/A' }}</div>
                            <div><strong>Year:</strong> {{ $allotment->application->academic_year ?? 'N/A' }}</div>
                        </td>
                        <td>
                            <div><strong>Allocated by:</strong></div>
                            <div>{{ $allotment->admin->name ?? 'N/A' }}</div>
                            <div style="font-size: 10px; color: #666;">{{ ucfirst($allotment->admin->role ?? 'Admin') }}</div>
                            <div style="font-size: 10px; color: #666;">App ID: #{{ $allotment->application->application_id ?? 'N/A' }}</div>
                        </td>
                        <td>
                            <div><strong>Start:</strong> {{ \Carbon\Carbon::parse($allotment->start_date)->format('M j, Y') }}</div>
                            @if($allotment->end_date)
                                <div><strong>End:</strong> {{ \Carbon\Carbon::parse($allotment->end_date)->format('M j, Y') }}</div>
                            @else
                                <div style="color: #28a745;"><strong>Ongoing</strong></div>
                            @endif
                            <div style="font-size: 10px; color: #666;">{{ \Carbon\Carbon::parse($allotment->start_date)->diffForHumans() }}</div>
                        </td>
                        <td>
                            <span class="status-active">{{ ucfirst($allotment->status) }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($allocatedStudents->count() > 20)
        <div class="page-break"></div>
        
        <div class="header">
            <h1>Block-wise Distribution</h1>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Block</th>
                    <th>Total Students</th>
                    <th>Rooms Occupied</th>
                    <th>Floors Used</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allocatedStudents->groupBy('seat.block') as $block => $students)
                    <tr>
                        <td><strong>{{ $block }} Block</strong></td>
                        <td>{{ $students->count() }}</td>
                        <td>{{ $students->pluck('seat.room_number')->unique()->count() }}</td>
                        <td>{{ $students->pluck('seat.floor')->unique()->implode(', ') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div style="margin-top: 20px;">
            <h3>Department-wise Distribution</h3>
            <table>
                <thead>
                    <tr>
                        <th>Department</th>
                        <th>Total Students</th>
                        <th>Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allocatedStudents->groupBy('application.department') as $department => $students)
                        <tr>
                            <td>{{ $department ?? 'N/A' }}</td>
                            <td>{{ $students->count() }}</td>
                            <td>{{ round(($students->count() / $allocatedStudents->count()) * 100, 1) }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="footer">
        <p>This report was generated automatically by the Hall Seat and Complaint Management System.</p>
        <p>Report generated on {{ date('F j, Y \a\t g:i A') }} | Total Pages: {{ ceil($allocatedStudents->count() / 20) }}</p>
    </div>
</body>
</html>
