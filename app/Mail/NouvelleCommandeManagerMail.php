<?php
namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NouvelleCommandeManagerMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Commande $commande) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Nouvelle commande #' . $this->commande->id);
    }

    public function content(): Content
    {
        return new Content(markdown: 'emails.commandes.manager');
    }
}
