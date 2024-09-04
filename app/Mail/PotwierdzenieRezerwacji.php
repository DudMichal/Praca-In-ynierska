<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PotwierdzenieRezerwacji extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $podsumowanie;
    public function __construct($podsumowanie)
    {
        $this->podsumowanie = $podsumowanie;
    }
    public function build()
    {
        return $this->view('mail/potwierdzenie_rezerwacji');
        // Możesz również ustawić temat, nagłówki itp.
    }

}
