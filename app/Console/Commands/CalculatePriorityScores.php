<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CalculatePriorityScores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'priority:calculate-scores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate priority scores for all seat applications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting priority score calculation...');

        $applications = \App\Models\SeatApplication::all();
        $bar = $this->output->createProgressBar($applications->count());
        $bar->start();

        $updated = 0;
        foreach ($applications as $application) {
            try {
                $oldScore = $application->priority_score ?? 0;
                $newScore = $application->calculatePriorityScore();
                $application->save();

                if ($oldScore != $newScore) {
                    $updated++;
                }

                $bar->advance();
            } catch (\Exception $e) {
                $this->error("Error processing application {$application->application_id}: " . $e->getMessage());
            }
        }

        $bar->finish();
        $this->newLine();

        $this->info("Priority scores calculated successfully!");
        $this->info("Total applications processed: " . $applications->count());
        $this->info("Applications updated: " . $updated);

        return 0;
    }
}
