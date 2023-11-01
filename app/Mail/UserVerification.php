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

class UserVerification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $html;
    public $subject;

    public function __construct(public $data)
    {
        $email = MailTemplate::where("mailable", "=", "App\Mail\ContactUs")->first();
        $this->html = Helpers::updateEmailTemplateValues($data, $email->html_template);
        $this->subject = Helpers::updateEmailTemplateValues($data, $email->subject);

        // dd($data);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    public function build()
    {
        return $this->markdown('emails.user-verification'); // -> pointing to views/mail/new-message.blade.php containing above message
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
