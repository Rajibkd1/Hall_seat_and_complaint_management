<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $primaryKey = 'seat_id';  // Primary Key

    protected $fillable = [
        'floor', 'block', 'seat_number', 'room_number', 'bed_number', 'status', 'last_updated',
    ];

    // Relationships
    public function seatAllotments()
    {
        return $this->hasMany(SeatAllotment::class, 'seat_id');
    }

    /**
     * Get the current active student for this seat
     */
    public function currentStudent()
    {
        return $this->hasOneThrough(
            Student::class,
            SeatAllotment::class,
            'seat_id', // Foreign key on SeatAllotment table
            'student_id', // Foreign key on Student table
            'seat_id', // Local key on Seat table
            'student_id' // Local key on SeatAllotment table
        )->where('seat_allotments.status', 'active');
    }

    /**
     * Get the current active admin who assigned this seat
     */
    public function currentAdmin()
    {
        return $this->hasOneThrough(
            Admin::class,
            SeatAllotment::class,
            'seat_id', // Foreign key on SeatAllotment table
            'admin_id', // Foreign key on Admin table
            'seat_id', // Local key on Seat table
            'admin_id' // Local key on SeatAllotment table
        )->where('seat_allotments.status', 'active');
    }

    /**
     * Get the current active application for this seat
     */
    public function currentApplication()
    {
        return $this->hasOneThrough(
            SeatApplication::class,
            SeatAllotment::class,
            'seat_id', // Foreign key on SeatAllotment table
            'application_id', // Foreign key on SeatApplication table
            'seat_id', // Local key on Seat table
            'application_id' // Local key on SeatAllotment table
        )->where('seat_allotments.status', 'active');
    }

    /**
     * Get the current active allotment for this seat
     */
    public function currentAllotment()
    {
        return $this->hasOne(SeatAllotment::class, 'seat_id')
                   ->where('status', 'active')
                   ->with(['student', 'admin', 'application']);
    }

    /**
     * Get all students who have occupied this seat (historical)
     */
    public function students()
    {
        return $this->hasManyThrough(
            Student::class,
            SeatAllotment::class,
            'seat_id', // Foreign key on SeatAllotment table
            'student_id', // Foreign key on Student table
            'seat_id', // Local key on Seat table
            'student_id' // Local key on SeatAllotment table
        );
    }

    /**
     * Get all admins who have assigned this seat (historical)
     */
    public function admins()
    {
        return $this->hasManyThrough(
            Admin::class,
            SeatAllotment::class,
            'seat_id', // Foreign key on SeatAllotment table
            'admin_id', // Foreign key on Admin table
            'seat_id', // Local key on Seat table
            'admin_id' // Local key on SeatAllotment table
        );
    }

    /**
     * Scope to get only occupied seats
     */
    public function scopeOccupied($query)
    {
        return $query->where('status', 'occupied');
    }

    /**
     * Scope to get only vacant seats
     */
    public function scopeVacant($query)
    {
        return $query->where('status', 'vacant');
    }

    /**
     * Scope to get only maintenance seats
     */
    public function scopeMaintenance($query)
    {
        return $query->where('status', 'maintenance');
    }

    /**
     * Check if seat is currently occupied
     */
    public function isOccupied()
    {
        return $this->status === 'occupied';
    }

    /**
     * Check if seat is currently vacant
     */
    public function isVacant()
    {
        return $this->status === 'vacant';
    }

    /**
     * Check if seat is under maintenance
     */
    public function isUnderMaintenance()
    {
        return $this->status === 'maintenance';
    }

    /**
     * Get formatted seat information
     */
    public function getFormattedInfoAttribute()
    {
        return "Room {$this->room_number}, Bed {$this->bed_number}, Floor {$this->floor}, {$this->block} Block";
    }
}

