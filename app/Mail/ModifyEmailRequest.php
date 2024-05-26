<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\MailTemplate;
use App\Helpers\Helpers;

class ModifyEmailRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     
    public $mailData;

    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {

        return $this->subject('Modifica richiesta e-mail')->markdown('emails.modify-email-request');
    }


}
