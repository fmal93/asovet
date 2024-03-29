<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $subject; 

    public $name;

    public $email;

    public $msg; 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $subject, $msg)
    {
        $this->subject = $subject;
        $this->name = $name;
        $this->email = $email;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email)->view('layouts.contactMessage')->withSwiftMessage(function ($message) {
            $message->getHeaders()
                ->addTextHeader($this->subject, $this->subject);
        }); 
    }
}
