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

        return $this->subject('Modify Email Request')->view('emails.modify-email-request');
    }


}
