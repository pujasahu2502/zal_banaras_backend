<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerPasswordResetMail extends Mailable{
    use Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $url){
        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        $user = $this->user;
        $subject = "Reset Password Link from DNZ Products!";
        return $this->view('vendor.notifications.email')->replyTo('dnzproductrt@gmail.com', 'DNZ Products Team')->subject($subject)->with(['user' => $user, 'url' => $this->url]);
    }
}