<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    use HasFactory;

    protected $primaryKey = 'super_admin_id'; // Primary Key

    protected $fillable = [
        'name', 'email', 'phone', 'password_hash',
    ];
}

