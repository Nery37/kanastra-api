<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Entities\Billet;
use Illuminate\Bus\Batchable;

class BillingNotification extends Mailable
{
    use Batchable, Queueable, SerializesModels;

    public $billet;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $billet)
    {
        $this->billet = $billet;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Seu boleto de cobrança')
                    ->view('emails.billing_notification', $this->billet);
    }
}
