<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $tries = 3;
    public $timeout = 30;

    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Simulate data processing
        Log::info('Processing data job', ['data' => $this->data]);
        
        // Simulate some processing time
        usleep(100000); // 0.1 second
        
        // Add processing metadata
        $this->data['processed_at'] = now()->toISOString();
        $this->data['job_id'] = $this->job ? $this->job->getJobId() : null;
        
        Log::info('Data processed successfully', ['result' => $this->data]);
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('Data processing job failed', [
            'data' => $this->data,
            'error' => $exception->getMessage()
        ]);
    }
}