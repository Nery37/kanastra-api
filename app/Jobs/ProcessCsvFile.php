<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use League\Csv\Reader;
use App\Jobs\ProcessCsvRecord;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

class ProcessCsvFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $fileName;

    /**
     * Create a new job instance.
     *
     * @param string $filePath
     * @return void
     */
    public function __construct($filePath, $fileName)
    {
        $this->filePath = $filePath;
        $this->fileName = $fileName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = storage_path('app/public/' . $this->filePath);
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);

        $chunkSize = 5000;
        $records = iterator_to_array($csv->getRecords());

        $chunks = array_chunk($records, $chunkSize);
        $fileName = $this->fileName;

        foreach ($chunks as $index => $chunk) {
            $jobs = [];
            $billets = [];

            foreach ($chunk as $record) {
                $jobs[] = new ProcessCsvRecord($record);
                $billets[] = new SendBillingEmail($record);
            }

            Bus::batch($jobs)->name("Process CSV Chunk " . $this->fileName . " - Part " . ($index + 1))
            ->then(function (Batch $batch) use ($billets, $index, $fileName){
                Bus::batch($billets)->name("Send Billing Emails " . $fileName . " - Part " . ($index + 1))->dispatch();
            })
            ->dispatch();
        }
    }
}
