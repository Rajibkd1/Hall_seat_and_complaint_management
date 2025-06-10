<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $primaryKey = 'notification_id'; // Primary Key

    protected $fillable = [
        'user_type', 'user_id', 'type', 'message', 'status', 'created_at',
    ];

    // Relationships
    public function user()
    {
        return $this->morphTo();
    }
}

