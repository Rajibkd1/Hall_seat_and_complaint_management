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
        'cgpa',
        'physical_condition',
        'family_status',
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
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
