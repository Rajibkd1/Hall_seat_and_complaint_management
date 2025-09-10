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
        'id_card_front',
        'id_card_back',
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
        'is_active',
        'profile_completed',
        'activated_at',
        'profile_completed_at',
    ];

    protected $hidden = [
        'password_hash',
    ];

    protected $appends = ['profile_image_url'];

    protected $casts = [
        'activated_at' => 'datetime',
        'profile_completed_at' => 'datetime',
    ];

    // Relationships
    public function seatApplications()
    {
        return $this->hasMany(SeatApplication::class, 'student_id');
    }

    public function seatAllotment()
    {
        return $this->hasOne(SeatAllotment::class, 'student_id');
    }

    public function currentSeat()
    {
        return $this->hasOneThrough(
            Seat::class,
            SeatAllotment::class,
            'student_id',
            'seat_id',
            'student_id',
            'seat_id'
        );
    }

    // Accessors
    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image
            ? asset('storage/' . $this->profile_image)
            : asset('images/default-avatar.png');
    }

    public function getIdCardFrontUrlAttribute()
    {
        return $this->id_card_front
            ? asset('storage/' . $this->id_card_front)
            : null;
    }

    public function getIdCardBackUrlAttribute()
    {
        return $this->id_card_back
            ? asset('storage/' . $this->id_card_back)
            : null;
    }

    // Helper methods
    public function hasActiveSeat()
    {
        return $this->seatAllotment()->exists();
    }

    public function getSeatDetails()
    {
        if ($this->hasActiveSeat()) {
            $allotment = $this->seatAllotment()->with('seat')->first();
            return $allotment ? $allotment->seat : null;
        }
        return null;
    }

    public function isAccountActive()
    {
        return $this->is_active;
    }

    public function isProfileCompleted()
    {
        return $this->profile_completed;
    }

    public function canLogin()
    {
        return $this->is_active && $this->profile_completed;
    }

    public function needsProfileCompletion()
    {
        return !$this->profile_completed;
    }

    public function needsAccountActivation()
    {
        return !$this->is_active;
    }
}
