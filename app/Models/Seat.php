<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $primaryKey = 'seat_id';  // Primary Key

    protected $fillable = [
        'room_number', 'bed_number', 'status', 'last_updated',
    ];

    // Relationships
    public function seatAllotments()
    {
        return $this->hasMany(SeatAllotment::class, 'seat_id');
    }
}

