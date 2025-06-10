<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $primaryKey = 'admin_id';  // Primary Key

    protected $fillable = [
        'name', 'email', 'phone', 'role', 'department', 'teacher_id', 'password_hash',
    ];

    // Relationships
    public function seatAllotments()
    {
        return $this->hasMany(SeatAllotment::class, 'admin_id');
    }
}

