<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactsMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $title;
    public $body;
    public $receiver;
    public function __construct($body,$title,$receiver)
    {
        $this->body = $body;
        $this->title = $title;
        $this->receiver = $receiver;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->title;
        return $this->view('emails.contacts')
            ->from($this->receiver)
            ->subject($subject);
    }
}
