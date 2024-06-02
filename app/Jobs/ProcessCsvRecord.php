<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\BillingService;
use Illuminate\Bus\Batchable;
use Illuminate\Support\Facades\Log;

class ProcessCsvRecord implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $record;

    public $timeout = 600; 

    /**
     * Create a new job instance.
     *
     * @param array $chunk
     * @return void
     */
    public function __construct(array $record)
    {
        $this->record = $record;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(BillingService $billingService)
    {
        $billingService->processRecord($this->record);
    }
}
