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

class ProfileEditApprovalNotification  extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $status;
    public $reason; 

   public function __construct($status, $reason = null, $user=null)
    {
        $this->user = $user;
        $this->status = $status;
        $this->reason = $reason;
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        $subject = 'Profile Edit ' . ucfirst($this->status);

        return $this->subject($subject)
                    ->markdown('emails.profile-edit-approval-notification');
    }
}
