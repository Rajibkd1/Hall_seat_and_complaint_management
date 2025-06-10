<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatAllotment extends Model
{
    use HasFactory;

    protected $primaryKey = 'allotment_id'; // Primary Key

    protected $fillable = [
        'seat_id', 'student_id', 'application_id', 'admin_id', 'start_date', 'end_date', 'status',
    ];

    // Relationships
    public function seat()
    {
        return $this->belongsTo(Seat::class, 'seat_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function application()
    {
        return $this->belongsTo(SeatApplication::class, 'application_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}

