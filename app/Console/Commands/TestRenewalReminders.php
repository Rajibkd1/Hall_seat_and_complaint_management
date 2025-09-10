<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SeatAllotment;
use App\Models\Student;
use Carbon\Carbon;

class TestRenewalReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:renewal-reminders {--student-id=} {--days=29}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the renewal reminder system by simulating different scenarios';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $studentId = $this->option('student-id');
        $days = $this->option('days');

        if (!$studentId) {
            $this->error('Please provide a student ID using --student-id option');
            return 1;
        }

        $student = Student::find($studentId);
        if (!$student) {
            $this->error("Student with ID {$studentId} not found");
            return 1;
        }

        $allotment = SeatAllotment::where('student_id', $studentId)
            ->where('status', 'active')
            ->first();

        if (!$allotment) {
            $this->error("No active seat allocation found for student {$studentId}");
            return 1;
        }

        $this->info("Testing renewal reminders for student: {$student->name}");
        $this->info("Current remaining days: {$allotment->remaining_days}");
        $this->info("Simulating {$days} days remaining...");

        // Temporarily modify the allocation expiry date for testing
        $originalExpiryDate = $allotment->allocation_expiry_date;
        $testExpiryDate = Carbon::now()->addDays($days)->format('Y-m-d');

        $allotment->update(['allocation_expiry_date' => $testExpiryDate]);

        // Reset reminder flags for testing
        $allotment->update([
            'reminder_29_days_sent' => false,
            'reminder_20_days_sent' => false,
            'reminder_10_days_sent' => false,
            'reminder_29_days_sent_at' => null,
            'reminder_20_days_sent_at' => null,
            'reminder_10_days_sent_at' => null,
        ]);

        $this->info("Testing reminder logic...");

        // Test the reminder logic
        if ($allotment->needsReminderEmail(29)) {
            $this->info("✓ Would send 29-day reminder");
        } elseif ($allotment->needsReminderEmail(20)) {
            $this->info("✓ Would send 20-day reminder");
        } elseif ($allotment->needsReminderEmail(10)) {
            $this->info("✓ Would send 10-day reminder");
        } else {
            $this->info("✗ No reminder needed at this time");
        }

        // Restore original expiry date
        $allotment->update(['allocation_expiry_date' => $originalExpiryDate]);

        $this->info("Test completed. Original expiry date restored.");

        return 0;
    }
}
