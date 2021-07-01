<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class invoice_email extends Mailable
{
    use Queueable, SerializesModels;
    public $full_name, $amount, $due_date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($full_name, $amount, $due_date)
    {
        $this->full_name = $full_name;
        $this->amount = $amount;
        $this->due_date = $due_date;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('brad@sandbox12207c6e7545487bac30cca57910d559.mailgun.org')->subject('invoice')->view('emails.invoice');
    }
}
