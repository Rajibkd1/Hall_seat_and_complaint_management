<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatApplication extends Model
{
    use HasFactory;

    protected $primaryKey = 'application_id';

    protected $fillable = [
        'student_id',
        'student_name',
        'department',
        'roll_number',
        'academic_year',
        'guardian_name',
        'guardian_mobile',
        'guardian_relationship',
        'program',
        'semester_year',
        'semester_term',
        'number_of_semester',
        'cgpa',
        'physical_condition',
        'family_status',
        'division',
        'district',
        'permanent_address',
        'current_address',
        'activities',
        'other_info',
        'university_id_doc',
        'marksheet_doc',
        'birth_certificate_doc',
        'financial_certificate_doc',
        'death_certificate_doc',
        'medical_certificate_doc',
        'activity_certificate_doc',
        'signature_doc',
        'other_doc_1',
        'other_doc_2',
        'other_doc_3',
        'family_member',
        'father_name',
        'mother_name',
        'father_profession',
        'mother_profession',
        'other_guardian',
        'guardian_monthly_income',
        'declaration_info_correct',
        'declaration_will_stay',
        'declaration_seven_days',
        'application_date',
        'home_distance_km',
        'financial_need',
        'guardian_yearly_income',
        'special_quota',
        'disciplinary_status',
        'BNCC_status',
        'documents_uploaded',
        'special_note',
        'type',
        'status',
        'score',
        'submission_date',
        'admin_override',
        'notes',
    ];

    protected $dates = ['application_date', 'submission_date'];
    protected $casts = [
        'application_date' => 'datetime',
        'submission_date' => 'datetime',
    ];
    public function canBeEdited(): bool
    {
        // Check if the application can be edited (within 3 days of submission)
        return $this->submission_date->diffInDays(now()) <= 3;
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function seatAllotments()
    {
        return $this->hasMany(SeatAllotment::class, 'application_id');
    }

    /**
     * Get the audit logs for this application.
     */
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class, 'application_id', 'application_id');
    }

    /**
     * Get the valid status values.
     */
    public static function getStatusOptions(): array
    {
        return ['pending', 'approved', 'verified', 'rejected', 'waitlisted', 'allocated'];
    }

    /**
     * Calculate priority score based on various criteria
     */
    public function calculatePriorityScore(): float
    {
        $score = 0;
        $breakdown = [];

        // 1. Distance from Noakhali (greater distance = higher score)
        $distanceScore = min($this->home_distance_km / 10, 20); // Max 20 points for distance
        $score += $distanceScore;
        $breakdown['distance'] = round($distanceScore, 2);

        // 2. Guardian deceased status (check from death certificate or family status)
        $hasDeathCertificate = !empty($this->death_certificate_doc);
        $familyStatus = strtolower($this->family_status ?? '');
        $guardianDeceased = $hasDeathCertificate || str_contains($familyStatus, 'deceased') || str_contains($familyStatus, 'orphan');

        if ($guardianDeceased) {
            $score += 15; // 15 points for deceased guardian
            $breakdown['guardian_deceased'] = 15;
        } else {
            $breakdown['guardian_deceased'] = 0;
        }

        // 3. Program level (PhD = higher priority)
        $programLevel = strtolower($this->program ?? 'undergraduate');
        if (str_contains($programLevel, 'phd') || str_contains($programLevel, 'doctorate')) {
            $score += 20; // 20 points for PhD
            $breakdown['program_level'] = 20;
        } elseif (str_contains($programLevel, 'masters') || str_contains($programLevel, 'ms')) {
            $score += 10; // 10 points for Masters
            $breakdown['program_level'] = 10;
        } else {
            $breakdown['program_level'] = 0;
        }

        // 4. CGPA (higher CGPA = higher score)
        $cgpaScore = min(($this->cgpa - 2.0) * 5, 20); // Max 20 points for CGPA
        $score += max(0, $cgpaScore);
        $breakdown['cgpa'] = round(max(0, $cgpaScore), 2);

        // 5. Extracurricular activities (more activities = higher score)
        $activities = $this->activities ?? [];
        if (is_string($activities)) {
            $activities = json_decode($activities, true) ?? [];
        }
        $activityCount = is_array($activities) ? count($activities) : 0;
        $activityScore = min($activityCount * 2, 15); // Max 15 points for activities
        $score += $activityScore;
        $breakdown['extracurricular'] = $activityScore;

        // 6. Years completed in university (estimate from semester)
        $semesterYear = $this->semester_year ?? 1;
        $yearsCompleted = max(0, $semesterYear - 1);
        $yearsScore = min($yearsCompleted * 1.5, 10); // Max 10 points for years
        $score += $yearsScore;
        $breakdown['years_completed'] = $yearsScore;

        // Convert to percentage (max score is 100)
        $percentageScore = min(($score / 100) * 100, 100);

        // Store the score in the existing score field
        $this->score = round($percentageScore, 2);

        return $percentageScore;
    }

    /**
     * Get priority score as percentage
     */
    public function getPriorityScorePercentage(): float
    {
        if ($this->score > 0) {
            return $this->score;
        }

        return $this->calculatePriorityScore();
    }

    /**
     * Get score breakdown (calculated on-the-fly)
     */
    public function getScoreBreakdown(): array
    {
        // Calculate breakdown without storing it
        $breakdown = [];

        // Distance score
        $distanceScore = min($this->home_distance_km / 10, 20);
        $breakdown['distance'] = round($distanceScore, 2);

        // Guardian deceased
        $hasDeathCertificate = !empty($this->death_certificate_doc);
        $familyStatus = strtolower($this->family_status ?? '');
        $guardianDeceased = $hasDeathCertificate || str_contains($familyStatus, 'deceased') || str_contains($familyStatus, 'orphan');
        $breakdown['guardian_deceased'] = $guardianDeceased ? 15 : 0;

        // Program level
        $programLevel = strtolower($this->program ?? 'undergraduate');
        if (str_contains($programLevel, 'phd') || str_contains($programLevel, 'doctorate')) {
            $breakdown['program_level'] = 20;
        } elseif (str_contains($programLevel, 'masters') || str_contains($programLevel, 'ms')) {
            $breakdown['program_level'] = 10;
        } else {
            $breakdown['program_level'] = 0;
        }

        // CGPA
        $cgpaScore = min(($this->cgpa - 2.0) * 5, 20);
        $breakdown['cgpa'] = round(max(0, $cgpaScore), 2);

        // Activities
        $activities = $this->activities ?? [];
        if (is_string($activities)) {
            $activities = json_decode($activities, true) ?? [];
        }
        $activityCount = is_array($activities) ? count($activities) : 0;
        $breakdown['extracurricular'] = min($activityCount * 2, 15);

        // Years completed
        $semesterYear = $this->semester_year ?? 1;
        $yearsCompleted = max(0, $semesterYear - 1);
        $breakdown['years_completed'] = min($yearsCompleted * 1.5, 10);

        return $breakdown;
    }

    /**
     * Get priority level (High, Medium, Low)
     */
    public function getPriorityLevel(): string
    {
        $score = $this->getPriorityScorePercentage();

        if ($score >= 80) {
            return 'High';
        } elseif ($score >= 60) {
            return 'Medium';
        } else {
            return 'Low';
        }
    }
}
