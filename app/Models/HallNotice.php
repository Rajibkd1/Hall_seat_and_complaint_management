<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallNotice extends Model
{
    use HasFactory;

    protected $primaryKey = 'notice_id'; // Primary Key

    protected $fillable = [
        'title', 'notice_type', 'description', 'date_posted', 'admin_id', 
        'valid_from', 'valid_until', 'status', 'attachment', 'updated_at',
    ];

    // Relationships
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
