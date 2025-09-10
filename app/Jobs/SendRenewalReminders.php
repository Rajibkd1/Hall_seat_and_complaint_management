<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Bus\Queueable as BusQueueable;
use App\Models\SeatAllotment;
use App\Mail\SeatRenewalReminder;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendRenewalReminders implements ShouldQueue
{
    use BusQueueable, Queueable, SerializesModels, InteractsWithQueue;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Get allotments that need renewal reminders
        $allotments = SeatAllotment::where('status', 'active')
            ->where('renewal_required', true)
            ->where('renewal_reminder_sent', false)
            ->where('allocation_expiry_date', '<=', Carbon::now()->addDays(30))
            ->with(['student', 'seat'])
            ->get();

        foreach ($allotments as $allotment) {
            if ($allotment->needsRenewalReminder()) {
                try {
                    Mail::to($allotment->student->email)
                        ->send(new SeatRenewalReminder($allotment));

                    $allotment->update(['renewal_reminder_sent' => true]);

                    \Log::info("Renewal reminder sent to student: {$allotment->student->email}");
                } catch (\Exception $e) {
                    \Log::error("Failed to send renewal reminder to {$allotment->student->email}: " . $e->getMessage());
                }
            }
        }
    }
}
