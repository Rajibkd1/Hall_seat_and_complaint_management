<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendRenewalReminders;

class SendRenewalRemindersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'renewal:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send renewal reminders to students whose seat allocations are expiring soon';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to send renewal reminders...');

        // Dispatch the job
        SendRenewalReminders::dispatch();

        $this->info('Renewal reminders job dispatched successfully.');
    }
}
