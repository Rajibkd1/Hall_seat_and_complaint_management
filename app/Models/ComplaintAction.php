<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintAction extends Model
{
    use HasFactory;

    protected $primaryKey = 'action_id'; // Primary Key

    protected $fillable = [
        'complaint_id', 'admin_id', 'action_type', 'notes', 'timestamp',
    ];

    // Relationships
    public function complaint()
    {
        return $this->belongsTo(Complaint::class, 'complaint_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
