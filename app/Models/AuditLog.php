<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    protected $primaryKey = 'log_id';
    protected $table = 'application_audit_logs';

    protected $fillable = [
        'application_id',
        'admin_id',
        'action_type',
        'old_status',
        'new_status',
        'message',
        'details'
    ];

    /**
     * Get the application that this log belongs to.
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(SeatApplication::class, 'application_id', 'application_id');
    }

    /**
     * Get the admin who performed the action.
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    }
}
