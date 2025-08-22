<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallNotice extends Model
{
    use HasFactory;

    protected $primaryKey = 'notice_id';
    
    // Approval status constants
    const STATUS_DRAFT = 'draft';
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    
    protected $fillable = [
        'title',
        'notice_type',
        'description',
        'date_posted',
        'admin_id',
        'valid_from',
        'valid_until',
        'status',
        'attachment',
        'approval_status',
        'approved_by',
        'approved_at',
        'approval_comment'
    ];

    protected $casts = [
        'date_posted' => 'datetime',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
        'approved_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(Admin::class, 'approved_by', 'admin_id');
    }

    // Status checking methods
    public function isDraft()
    {
        return $this->approval_status === self::STATUS_DRAFT;
    }

    public function isPending()
    {
        return $this->approval_status === self::STATUS_PENDING;
    }

    public function isApproved()
    {
        return $this->approval_status === self::STATUS_APPROVED;
    }

    public function isRejected()
    {
        return $this->approval_status === self::STATUS_REJECTED;
    }

    public function needsApproval()
    {
        return $this->admin && $this->admin->isCoProvost() && $this->isDraft();
    }

    public function canBePublished()
    {
        return $this->isApproved() || ($this->admin && $this->admin->isProvost());
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('notice_type', $type);
    }

    public function scopeApproved($query)
    {
        return $query->where('approval_status', self::STATUS_APPROVED);
    }

    public function scopePending($query)
    {
        return $query->where('approval_status', self::STATUS_PENDING);
    }

    public function scopeDraft($query)
    {
        return $query->where('approval_status', self::STATUS_DRAFT);
    }

    public function scopeRejected($query)
    {
        return $query->where('approval_status', self::STATUS_REJECTED);
    }

    public function scopePublishable($query)
    {
        return $query->where(function($q) {
            $q->where('approval_status', self::STATUS_APPROVED)
              ->orWhereHas('admin', function($adminQuery) {
                  $adminQuery->where('role_type', Admin::ROLE_PROVOST);
              });
        });
    }
}
