<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SeatApplication;
use App\Models\Student;
use Carbon\Carbon;

class SeatApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, let's create some students if they don't exist
        $students = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@university.edu',
                'university_id' => 'CSE2021001',
                'phone' => '01712345678',
                'department' => 'Computer Science',
                'session_year' => 2021,
                'current_address' => 'University Area, Dhaka',
                'permanent_address' => 'Dhaka, Bangladesh',
                'father_name' => 'John Doe Sr.',
                'mother_name' => 'Jane Doe',
                'guardian_alive_status' => true,
                'guardian_contact' => '01987654321',
                'password_hash' => bcrypt('password'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@university.edu',
                'university_id' => 'EEE2021002',
                'phone' => '01712345679',
                'department' => 'Electrical Engineering',
                'session_year' => 2021,
                'current_address' => 'University Area, Dhaka',
                'permanent_address' => 'Chittagong, Bangladesh',
                'father_name' => 'Robert Smith',
                'mother_name' => 'Mary Smith',
                'guardian_alive_status' => true,
                'guardian_contact' => '01987654322',
                'password_hash' => bcrypt('password'),
            ],
            [
                'name' => 'Ahmed Rahman',
                'email' => 'ahmed.rahman@university.edu',
                'university_id' => 'ME2020003',
                'phone' => '01712345680',
                'department' => 'Mechanical Engineering',
                'session_year' => 2020,
                'current_address' => 'University Area, Dhaka',
                'permanent_address' => 'Sylhet, Bangladesh',
                'father_name' => 'Abdul Rahman',
                'mother_name' => 'Fatima Rahman',
                'guardian_alive_status' => true,
                'guardian_contact' => '01987654323',
                'password_hash' => bcrypt('password'),
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@university.edu',
                'university_id' => 'BBA2021004',
                'phone' => '01712345681',
                'department' => 'Business Administration',
                'session_year' => 2021,
                'current_address' => 'University Area, Dhaka',
                'permanent_address' => 'Rajshahi, Bangladesh',
                'father_name' => 'David Johnson',
                'mother_name' => 'Lisa Johnson',
                'guardian_alive_status' => true,
                'guardian_contact' => '01987654324',
                'password_hash' => bcrypt('password'),
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael.brown@university.edu',
                'university_id' => 'ARCH2020005',
                'phone' => '01712345682',
                'department' => 'Architecture',
                'session_year' => 2020,
                'current_address' => 'University Area, Dhaka',
                'permanent_address' => 'Khulna, Bangladesh',
                'father_name' => 'James Brown',
                'mother_name' => 'Patricia Brown',
                'guardian_alive_status' => true,
                'guardian_contact' => '01987654325',
                'password_hash' => bcrypt('password'),
            ],
            [
                'name' => 'Fatima Ahmed',
                'email' => 'fatima.ahmed@university.edu',
                'university_id' => 'CSE2021006',
                'phone' => '01712345683',
                'department' => 'Computer Science',
                'session_year' => 2021,
                'current_address' => 'University Area, Dhaka',
                'permanent_address' => 'Barisal, Bangladesh',
                'father_name' => 'Mohammed Ahmed',
                'mother_name' => 'Aisha Ahmed',
                'guardian_alive_status' => true,
                'guardian_contact' => '01987654326',
                'password_hash' => bcrypt('password'),
            ],
            [
                'name' => 'David Wilson',
                'email' => 'david.wilson@university.edu',
                'university_id' => 'EEE2021007',
                'phone' => '01712345684',
                'department' => 'Electrical Engineering',
                'session_year' => 2021,
                'current_address' => 'University Area, Dhaka',
                'permanent_address' => 'Rangpur, Bangladesh',
                'father_name' => 'Robert Wilson',
                'mother_name' => 'Jennifer Wilson',
                'guardian_alive_status' => true,
                'guardian_contact' => '01987654327',
                'password_hash' => bcrypt('password'),
            ],
            [
                'name' => 'Aisha Khan',
                'email' => 'aisha.khan@university.edu',
                'university_id' => 'ME2020008',
                'phone' => '01712345685',
                'department' => 'Mechanical Engineering',
                'session_year' => 2020,
                'current_address' => 'University Area, Dhaka',
                'permanent_address' => 'Mymensingh, Bangladesh',
                'father_name' => 'Ali Khan',
                'mother_name' => 'Nadia Khan',
                'guardian_alive_status' => true,
                'guardian_contact' => '01987654328',
                'password_hash' => bcrypt('password'),
            ],
            [
                'name' => 'Robert Chen',
                'email' => 'robert.chen@university.edu',
                'university_id' => 'BBA2021009',
                'phone' => '01712345686',
                'department' => 'Business Administration',
                'session_year' => 2021,
                'current_address' => 'University Area, Dhaka',
                'permanent_address' => 'Dhaka, Bangladesh',
                'father_name' => 'William Chen',
                'mother_name' => 'Grace Chen',
                'guardian_alive_status' => true,
                'guardian_contact' => '01987654329',
                'password_hash' => bcrypt('password'),
            ],
            [
                'name' => 'Nadia Islam',
                'email' => 'nadia.islam@university.edu',
                'university_id' => 'ARCH2020010',
                'phone' => '01712345687',
                'department' => 'Architecture',
                'session_year' => 2020,
                'current_address' => 'University Area, Dhaka',
                'permanent_address' => 'Chittagong, Bangladesh',
                'father_name' => 'Mohammed Islam',
                'mother_name' => 'Amina Islam',
                'guardian_alive_status' => true,
                'guardian_contact' => '01987654330',
                'password_hash' => bcrypt('password'),
            ],
        ];

        // Bangladesh divisions and districts for realistic data
        $divisions = [
            'dhaka' => ['Dhaka', 'Gazipur', 'Narayanganj', 'Tangail', 'Narsingdi'],
            'chittagong' => ['Chittagong', 'Comilla', 'Chandpur', 'Lakshmipur', 'Noakhali'],
            'rajshahi' => ['Rajshahi', 'Natore', 'Naogaon', 'Chapainawabganj', 'Pabna'],
            'khulna' => ['Khulna', 'Bagerhat', 'Satkhira', 'Jessore', 'Magura'],
            'barisal' => ['Barisal', 'Bhola', 'Pirojpur', 'Patuakhali', 'Barguna'],
            'sylhet' => ['Sylhet', 'Moulvibazar', 'Habiganj', 'Sunamganj'],
            'rangpur' => ['Rangpur', 'Dinajpur', 'Kurigram', 'Gaibandha', 'Nilphamari'],
            'mymensingh' => ['Mymensingh', 'Jamalpur', 'Sherpur', 'Netrokona'],
        ];

        foreach ($students as $index => $studentData) {
            $student = Student::firstOrCreate(
                ['university_id' => $studentData['university_id']],
                $studentData
            );

            // Select division and district for this student
            $division = array_keys($divisions)[$index % count($divisions)];
            $district = $divisions[$division][$index % count($divisions[$division])];

            // Create seat applications for each student
            $applications = [
                [
                    'student_id' => $student->student_id,
                    'student_name' => $student->name,
                    'department' => $student->department,
                    'academic_year' => $student->session_year . '-' . ($student->session_year + 1),
                    'guardian_name' => 'Guardian of ' . $student->name,
                    'guardian_mobile' => '01987654321',
                    'guardian_relationship' => 'Father',
                    'program' => 'undergraduate',
                    'semester_year' => rand(1, 4),
                    'semester_term' => rand(1, 2),
                    'cgpa' => round(rand(250, 400) / 100, 2), // Random CGPA between 2.50 and 4.00
                    'physical_condition' => 'normal',
                    'family_status' => 'both-parents',
                    'division' => $division,
                    'district' => strtolower(str_replace(' ', '_', $district)),
                    'permanent_address' => $district . ', ' . ucfirst($division) . ', Bangladesh',
                    'current_address' => 'University Area, Dhaka',
                    'activities' => json_encode(['bncc']),
                    'other_info' => json_encode([]),
                    'declaration_info_correct' => true,
                    'declaration_will_stay' => true,
                    'declaration_seven_days' => true,
                    'application_date' => Carbon::now()->subDays(rand(1, 30)),
                    'home_distance_km' => rand(10, 500),
                    'financial_need' => rand(0, 1) == 1,
                    'guardian_yearly_income' => rand(200000, 1000000),
                    'special_quota' => null,
                    'disciplinary_status' => 'clear',
                    'BNCC_status' => 'active',
                    'documents_uploaded' => json_encode(['university_id', 'marksheet']),
                    'special_note' => 'Good academic record',
                    'type' => 'new',
                    'status' => $this->getRandomStatus(),
                    'score' => rand(60, 100),
                    'submission_date' => Carbon::now()->subDays(rand(1, 30)),
                    'admin_override' => false,
                    'notes' => 'Application processed',
                ]
            ];

            foreach ($applications as $applicationData) {
                SeatApplication::create($applicationData);
            }
        }

        // Create a few more approved applications for better testing
        for ($i = 0; $i < 3; $i++) {
            $randomStudent = Student::inRandomOrder()->first();
            if ($randomStudent) {
                // Select random division and district
                $randomDivision = array_keys($divisions)[array_rand($divisions)];
                $randomDistrict = $divisions[$randomDivision][array_rand($divisions[$randomDivision])];

                SeatApplication::create([
                    'student_id' => $randomStudent->student_id,
                    'student_name' => $randomStudent->name,
                    'department' => $randomStudent->department,
                    'academic_year' => $randomStudent->session_year . '-' . ($randomStudent->session_year + 1),
                    'guardian_name' => 'Guardian of ' . $randomStudent->name,
                    'guardian_mobile' => '01987654321',
                    'guardian_relationship' => 'Mother',
                    'program' => 'undergraduate',
                    'semester_year' => rand(1, 4),
                    'semester_term' => rand(1, 2),
                    'cgpa' => round(rand(350, 400) / 100, 2), // Higher CGPA for approved
                    'physical_condition' => 'normal',
                    'family_status' => 'both-parents',
                    'division' => $randomDivision,
                    'district' => strtolower(str_replace(' ', '_', $randomDistrict)),
                    'permanent_address' => $randomDistrict . ', ' . ucfirst($randomDivision) . ', Bangladesh',
                    'current_address' => 'University Area, Dhaka',
                    'activities' => json_encode(['rover']),
                    'other_info' => json_encode(['ethnic']),
                    'declaration_info_correct' => true,
                    'declaration_will_stay' => true,
                    'declaration_seven_days' => true,
                    'application_date' => Carbon::now()->subDays(rand(5, 20)),
                    'home_distance_km' => rand(50, 300),
                    'financial_need' => false,
                    'guardian_yearly_income' => rand(500000, 1500000),
                    'special_quota' => null,
                    'disciplinary_status' => 'clear',
                    'BNCC_status' => null,
                    'documents_uploaded' => json_encode(['university_id', 'marksheet', 'birth_certificate']),
                    'special_note' => 'Excellent student',
                    'type' => 'new',
                    'status' => 'approved', // Ensure these are approved
                    'score' => rand(85, 100),
                    'submission_date' => Carbon::now()->subDays(rand(5, 20)),
                    'admin_override' => false,
                    'notes' => 'Approved for excellent academic performance',
                ]);
            }
        }
    }

    private function getRandomStatus()
    {
        $statuses = ['pending', 'approved', 'rejected', 'waitlisted'];
        $weights = [40, 30, 20, 10]; // Higher chance for pending and approved

        $rand = rand(1, 100);
        $cumulative = 0;

        foreach ($weights as $index => $weight) {
            $cumulative += $weight;
            if ($rand <= $cumulative) {
                return $statuses[$index];
            }
        }

        return 'pending';
    }
}
