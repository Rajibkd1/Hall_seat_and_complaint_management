<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatAllotment extends Model
{
    use HasFactory;

    protected $primaryKey = 'allotment_id'; // Primary Key

    protected $fillable = [
        'seat_id',
        'student_id',
        'application_id',
        'admin_id',
        'start_date',
        'end_date',
        'status',
        'renewal_required',
        'renewal_reminder_sent',
        'renewal_deadline',
        'allocation_expiry_date',
        'reminder_29_days_sent',
        'reminder_20_days_sent',
        'reminder_10_days_sent',
        'reminder_29_days_sent_at',
        'reminder_20_days_sent_at',
        'reminder_10_days_sent_at',
    ];

    // Relationships
    public function seat()
    {
        return $this->belongsTo(Seat::class, 'seat_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function application()
    {
        return $this->belongsTo(SeatApplication::class, 'application_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function renewalApplications()
    {
        return $this->hasMany(SeatRenewalApplication::class, 'allotment_id');
    }

    public function latestRenewalApplication()
    {
        return $this->hasOne(SeatRenewalApplication::class, 'allotment_id')->latest();
    }

    // Renewal methods
    public function getRemainingDaysAttribute()
    {
        if (!$this->allocation_expiry_date) {
            return null;
        }

        $expiryDate = \Carbon\Carbon::parse($this->allocation_expiry_date);
        $now = \Carbon\Carbon::now();

        if ($expiryDate->isPast()) {
            return 0;
        }

        return $now->diffInDays($expiryDate, false);
    }

    public function isExpiringSoon()
    {
        return $this->remaining_days !== null && $this->remaining_days <= 30;
    }

    public function isExpired()
    {
        return $this->remaining_days !== null && $this->remaining_days <= 0;
    }

    public function needsRenewalReminder()
    {
        return $this->renewal_required &&
            !$this->renewal_reminder_sent &&
            $this->remaining_days !== null &&
            $this->remaining_days <= 30;
    }

    public function canApplyForRenewal()
    {
        return $this->status === 'active' &&
            $this->renewal_required &&
            $this->remaining_days !== null &&
            $this->remaining_days <= 30;
    }

    public function hasPendingRenewalApplication()
    {
        return $this->renewalApplications()
            ->where('status', 'pending')
            ->exists();
    }

    public function extendAllocation($months = 12)
    {
        // Store the original expiry date for logging
        $originalExpiryDate = $this->allocation_expiry_date;

        // Extend allocation by adding months to the CURRENT expiry date (not approval date)
        // This ensures the extension is from the existing expiry date, not from today
        $this->allocation_expiry_date = \Carbon\Carbon::parse($this->allocation_expiry_date)
            ->addMonths($months)
            ->format('Y-m-d');

        // Reset renewal flags since allocation is extended
        $this->renewal_required = false;
        $this->renewal_reminder_sent = false;

        // Reset all reminder flags when extending allocation
        $this->reminder_29_days_sent = false;
        $this->reminder_20_days_sent = false;
        $this->reminder_10_days_sent = false;
        $this->reminder_29_days_sent_at = null;
        $this->reminder_20_days_sent_at = null;
        $this->reminder_10_days_sent_at = null;

        $this->save();

        // Log the extension for audit purposes
        \Log::info('Seat allocation extended', [
            'allotment_id' => $this->allotment_id,
            'student_id' => $this->student_id,
            'original_expiry_date' => $originalExpiryDate,
            'new_expiry_date' => $this->allocation_expiry_date,
            'extension_months' => $months,
            'extended_at' => now()
        ]);
    }

    /**
     * Check if student needs a specific reminder email
     */
    public function needsReminderEmail($daysThreshold)
    {
        if (!$this->renewal_required || $this->remaining_days === null) {
            return false;
        }

        // Check if we're at the right day threshold
        $isAtThreshold = $this->remaining_days <= $daysThreshold;

        // Check if we haven't sent this specific reminder yet
        $notSentYet = false;
        switch ($daysThreshold) {
            case 29:
                $notSentYet = !$this->reminder_29_days_sent;
                break;
            case 20:
                $notSentYet = !$this->reminder_20_days_sent;
                break;
            case 10:
                $notSentYet = !$this->reminder_10_days_sent;
                break;
        }

        return $isAtThreshold && $notSentYet;
    }

    /**
     * Mark a specific reminder as sent
     */
    public function markReminderSent($daysThreshold)
    {
        $now = now();
        switch ($daysThreshold) {
            case 29:
                $this->reminder_29_days_sent = true;
                $this->reminder_29_days_sent_at = $now;
                break;
            case 20:
                $this->reminder_20_days_sent = true;
                $this->reminder_20_days_sent_at = $now;
                break;
            case 10:
                $this->reminder_10_days_sent = true;
                $this->reminder_10_days_sent_at = $now;
                break;
        }
        $this->save();
    }

    /**
     * Get the appropriate reminder type based on remaining days
     */
    public function getReminderType()
    {
        if ($this->remaining_days === null) {
            return null;
        }

        if ($this->remaining_days <= 10) {
            return 'urgent'; // 10 days or less
        } elseif ($this->remaining_days <= 20) {
            return 'warning'; // 11-20 days
        } elseif ($this->remaining_days <= 29) {
            return 'notice'; // 21-29 days
        }

        return null;
    }

    /**
     * Check if student has any pending renewal application
     */
    public function hasActiveRenewalApplication()
    {
        return $this->renewalApplications()
            ->whereIn('status', ['pending', 'approved'])
            ->exists();
    }
}
