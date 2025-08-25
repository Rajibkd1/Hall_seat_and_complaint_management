<!DOCTYPE html>
<html>

<head>
    <title>Application PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .student-info {
            margin-bottom: 20px;
        }

        .student-info img {
            max-width: 150px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .details {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .details p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <h1>Application Details</h1>
    <div class="student-info">
        @if ($student->profile_image)
            <img src="{{ asset('storage/' . $student->profile_image) }}" alt="Student Image">
        @endif
        <p><strong>Name:</strong> {{ $application->student_name }}</p>
        <p><strong>Department:</strong> {{ $application->department }}</p>
        <p><strong>University ID:</strong> {{ $application->university_id }}</p>
    </div>
    <div class="details">
        <h2>Application Form Details</h2>
        <p><strong>Guardian Name:</strong> {{ $application->guardian_name }}</p>
        <p><strong>Guardian Mobile:</strong> {{ $application->guardian_mobile }}</p>
        <p><strong>Program:</strong> {{ $application->program }}</p>
        <p><strong>CGPA:</strong> {{ $application->cgpa }}</p>
        <p><strong>Physical Condition:</strong> {{ $application->physical_condition }}</p>
        <p><strong>Family Status:</strong> {{ $application->family_status }}</p>
        <p><strong>Permanent Address:</strong> {{ $application->permanent_address }}</p>
        <p><strong>Current Address:</strong> {{ $application->current_address }}</p>
        <p><strong>Application Date:</strong> {{ $application->application_date->format('Y-m-d') }}</p>
    </div>
</body>

</html>
