<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $contactUs;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactUs)
    {
        $this->contactUs = $contactUs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->contactUs['subject'];
        return $this->view('email.customer-contact-us')->subject($subject)->with(['contactUs'=>$this->contactUs]);
    }
}
