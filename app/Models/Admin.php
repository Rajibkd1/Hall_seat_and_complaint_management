<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Use this instead of Model
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'admin_id';

    public $incrementing = true;

    // Role constants
    const ROLE_PROVOST = 'provost';
    const ROLE_CO_PROVOST = 'co_provost';
    const ROLE_STAFF = 'staff';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'role_type',
        'designation',
        'hall_name',
        'contact_number',
        'department',
        'teacher_id',
        'password_hash',
        'is_verified',
        'created_by',
        'verified_at',
    ];

    protected $hidden = [
        'password_hash',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
    ];

    /**
     * Get the password for the user.
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    // Role checking methods
    public function isProvost()
    {
        return $this->role_type === self::ROLE_PROVOST;
    }

    public function isCoProvost()
    {
        return $this->role_type === self::ROLE_CO_PROVOST;
    }

    public function isStaff()
    {
        return $this->role_type === self::ROLE_STAFF;
    }

    public function canAllocateSeats()
    {
        return $this->isProvost();
    }

    public function canApproveNotices()
    {
        return $this->isProvost();
    }

    public function canCreateAdmins()
    {
        return $this->isProvost();
    }

    public function canVerifyApplications()
    {
        return $this->isProvost() || $this->isCoProvost();
    }

    public function canManageComplaints()
    {
        return $this->isProvost() || $this->isCoProvost() || $this->isStaff();
    }

    public function canViewStudents()
    {
        return $this->isProvost() || $this->isCoProvost();
    }

    // Relationships
    public function seatAllotments()
    {
        return $this->hasMany(SeatAllotment::class, 'admin_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by', 'admin_id');
    }

    public function createdAdmins()
    {
        return $this->hasMany(Admin::class, 'created_by', 'admin_id');
    }

    public function notices()
    {
        return $this->hasMany(HallNotice::class, 'admin_id', 'admin_id');
    }

    public function approvedNotices()
    {
        return $this->hasMany(HallNotice::class, 'approved_by', 'admin_id');
    }

    // Scopes
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeByRoleType($query, $roleType)
    {
        return $query->where('role_type', $roleType);
    }

    public function scopeProvosts($query)
    {
        return $query->where('role_type', self::ROLE_PROVOST);
    }

    public function scopeCoProvosts($query)
    {
        return $query->where('role_type', self::ROLE_CO_PROVOST);
    }

    public function scopeStaff($query)
    {
        return $query->where('role_type', self::ROLE_STAFF);
    }
}
