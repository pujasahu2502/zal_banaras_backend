<?php

namespace App\Jobs;

use App\Mail\CustomerPasswordResetMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CustomerPasswordResetJob implements ShouldQueue{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user, $url;
    /**
     * 
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $url){
        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){
        if(env('MAIL_ACCESS') == true) {
            $user = new CustomerPasswordResetMail($this->user, $this->url);
            Mail::to($this->user['email'])->send($user);
        }
    }
}