<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SuperAdmin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'super_admin_id'; // Primary Key

    protected $fillable = [
        'name',
        'email',
        'phone',
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

    // Relationships
    public function createdProvosts()
    {
        return $this->hasMany(Admin::class, 'created_by', 'super_admin_id')
            ->where('role_type', Admin::ROLE_PROVOST);
    }
}
