<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Important!
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'student_id';

    public $incrementing = true;

    protected $fillable = [
        'name',
        'university_id',
        'profile_image',
        'university_id_card_image',
        'email',
        'phone',
        'department',
        'session_year',
        'current_address',
        'permanent_address',
        'father_name',
        'mother_name',
        'other_guardian',
        'guardian_alive_status',
        'guardian_contact',
        'password_hash',
    ];

    protected $hidden = [
        'password_hash',
    ];
    // Relationships
    public function seatApplications()
    {
        return $this->hasMany(SeatApplication::class, 'student_id');
    }
    protected $appends = ['profile_image_url'];
    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image
            ? asset('storage/' . $this->profile_image)
            : asset('images/default.png');
    }
}
