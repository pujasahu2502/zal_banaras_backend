<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerOrderMail extends Mailable{
    use Queueable, SerializesModels;

    protected $order, $userData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $userData){
        $this->order = $order;
        $this->userData = $userData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        $subject = 'Thank You For Your Order!';
        return $this->view('email.customer-order')->subject($subject)->with([
            'order' => $this->order,
            'userData' => $this->userData
        ]);
    }
}