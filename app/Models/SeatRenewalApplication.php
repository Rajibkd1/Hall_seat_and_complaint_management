<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatRenewalApplication extends Model
{
    use HasFactory;

    protected $primaryKey = 'renewal_id';

    protected $fillable = [
        'allotment_id',
        'student_id',
        'current_semesters',
        'last_semester_cgpa',
        'result_file_path',
        'additional_comments',
        'status',
        'submission_date',
        'reviewed_by',
        'reviewed_at',
        'admin_notes',
    ];

    protected $casts = [
        'submission_date' => 'datetime',
        'reviewed_at' => 'datetime',
        'last_semester_cgpa' => 'decimal:2',
    ];

    // Relationships
    public function allotment()
    {
        return $this->belongsTo(SeatAllotment::class, 'allotment_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(Admin::class, 'reviewed_by');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
