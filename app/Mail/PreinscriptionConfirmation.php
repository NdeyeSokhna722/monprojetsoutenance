<?php

namespace App\Mail;

use App\Models\Preinscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PreinscriptionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $preinscription;

    /**
     * Create a new message instance.
     */
    public function __construct(Preinscription $preinscription)
    {
        $this->preinscription = $preinscription;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de votre pré-inscription - Ndindy School',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.preinscription-confirmation',
            with: [
                'preinscription' => $this->preinscription,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}