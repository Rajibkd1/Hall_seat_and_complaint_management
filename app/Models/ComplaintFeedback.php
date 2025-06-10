<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintFeedback extends Model
{
    use HasFactory;

    protected $primaryKey = 'feedback_id'; // Primary Key

    protected $fillable = [
        'complaint_id', 'student_id', 'rating', 'comments', 'timestamp',
    ];

    // Relationships
    public function complaint()
    {
        return $this->belongsTo(Complaint::class, 'complaint_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
