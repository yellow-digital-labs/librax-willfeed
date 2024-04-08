<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProfileEditNotification extends Mailable
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
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Profile Edit Notification',
    //     );
    // }

    /**
     * Get the message content definition.
     */
      public function build()
    {
        $subject = 'Profile Edit ' . ucfirst($this->status);
        if($ths->staus == "rejected"){
           $subject = 'La tua richiesta di aggiornamento del profilo è stata rifiutata';
        }
        
        return $this->subject($subject)
                    ->markdown('emails.profile-edit-approval-notification');
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
