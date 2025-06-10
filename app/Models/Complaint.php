<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $primaryKey = 'complaint_id'; // Primary Key

    protected $fillable = [
        'student_id', 'category', 'description', 'emergency_flag', 'status', 'submission_date', 'image_url',
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function complaintActions()
    {
        return $this->hasMany(ComplaintAction::class, 'complaint_id');
    }

    public function complaintFeedback()
    {
        return $this->hasMany(ComplaintFeedback::class, 'complaint_id');
    }
}

