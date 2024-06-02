<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\BillingNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Batchable;

class SendBillingEmail implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $billet;

    /**
     * Create a new job instance.
     *
     * @param array $billet
     * @return void
     */
    public function __construct(array $billet)
    {
        $this->billet = $billet;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Sleep adicionado devido a limitação do serviço de envio de email utilizado (https://mailtrap.io/)
        sleep(5);
        Mail::to($this->billet['email'])->send(new BillingNotification($this->billet));
    }
}
