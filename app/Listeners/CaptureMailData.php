<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\EmailHistory;

class CaptureMailData
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageSent $event): void
    {
        EmailHistory::create([
            'to' => $event->message->getTo()[0]->getAddress(),
            'from' => $event->message->getFrom()[0]->getAddress(),
            'cc' => json_encode($event->message->getCc()),
            'bcc' => json_encode($event->message->getBcc()),
            'subject' => $event->message->getSubject(),
            'html' => $event->message->getHtmlBody(),
            'sent_at' => date('Y-m-d H:i:s')
        ]);
    }
}
