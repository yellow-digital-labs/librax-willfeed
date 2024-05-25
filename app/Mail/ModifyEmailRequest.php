<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ModifyEmailRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Modify Email Request Request',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view('emails.modify-email-request')
                    ->with(['token' => $this->token]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
