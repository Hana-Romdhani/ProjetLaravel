<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Plantation;

class PlantationCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $plantation;

    public function __construct(Plantation $plantation)
    {
        $this->plantation = $plantation;
    }

    public function build()
    {
        return $this->subject('Nouvelle plantation ajoutée')
                    ->markdown('emails.plantation.created');
    }
}
