<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'student_id',
        'ip_address',
        'user_agent',
        'is_read',
        'admin_response',
        'responded_by',
        'responded_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'responded_at' => 'datetime',
    ];

    /**
     * Get the student who sent the message (if authenticated)
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    /**
     * Get the admin who responded to the message
     */
    public function respondedBy()
    {
        return $this->belongsTo(Admin::class, 'responded_by');
    }

    /**
     * Scope for unread messages
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope for read messages
     */
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    /**
     * Scope for responded messages
     */
    public function scopeResponded($query)
    {
        return $query->whereNotNull('admin_response');
    }

    /**
     * Scope for pending messages
     */
    public function scopePending($query)
    {
        return $query->whereNull('admin_response');
    }
}
