<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Use this instead of Model
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'admin_id';

    public $incrementing = true;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'department',
        'teacher_id',
        'password_hash',
    ];

    protected $hidden = [
        'password_hash',
    ];

    /**
     * Get the password for the user.
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
    //Relationships
    public function seatAllotments()
    {
        return $this->hasMany(SeatAllotment::class, 'admin_id');
    }
}
