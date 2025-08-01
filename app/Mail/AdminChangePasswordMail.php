<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminChangePasswordMail extends Mailable{
    use Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user){
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        $subject = 'Password Changed!';
        return $this->view('email.admin-change-password')->subject($subject)->with(['user'=>$this->user]);
    }
}