<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerSubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $subscription;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Welcome to DNZ Products!';
        return $this->view('email.customer-subscription')->subject($subject)->with(['subscription'=>$this->subscription]);
    }
}
