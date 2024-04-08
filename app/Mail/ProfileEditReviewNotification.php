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

class ProfileEditReviewNotification  extends Mailable
{
    use Queueable, SerializesModels;

    public $editPageUrl;
    public $user;

    public function __construct($editPageUrl, $user)
    {
        $this->user = $user;
        $this->editPageUrl = $editPageUrl;
    }

    public function build()
    {
        $subject = 'Nuovo profilo Modifica da rivedere';

        return $this->subject($subject)
                  ->markdown('emails.profile-edit-review-notification');
    }
}
