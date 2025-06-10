<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_id'; // Primary Key

    protected $fillable = [
        'name', 'university_id', 'profile_image', 'university_id_card_image',
        'email', 'phone', 'department', 'session_year', 'current_address', 
        'permanent_address', 'father_name', 'mother_name', 'other_guardian', 
        'guardian_alive_status', 'guardian_contact', 'password_hash',
    ];

    // Relationships
    public function seatApplications()
    {
        return $this->hasMany(SeatApplication::class, 'student_id');
    }
}

