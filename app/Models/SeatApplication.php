<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatApplication extends Model
{
    use HasFactory;

    protected $primaryKey = 'application_id';  // Primary Key

    protected $fillable = [
        'student_id', 'cgpa', 'home_distance_km', 'financial_need', 'guardian_yearly_income',
        'special_quota', 'disciplinary_status', 'BNCC_status', 'documents_uploaded', 
        'special_note', 'type', 'status', 'score', 'submission_date', 'admin_override', 'notes',
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}

