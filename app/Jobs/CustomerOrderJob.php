<?php

namespace App\Jobs;

use App\Mail\CustomerOrderMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CustomerOrderJob implements ShouldQueue{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order, $userData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order, $userData){
        $this->order = $order;
        $this->userData = $userData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){
        if(env('MAIL_ACCESS') == true) {
            $order = new CustomerOrderMail ($this->order, $this->userData);
            // Mail ::to('himanshu.d@chapter247.com')->send($order);
            Mail ::to($this->userData['email'])->send($order);
        }
    }
}