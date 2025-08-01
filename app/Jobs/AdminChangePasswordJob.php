<?php

namespace App\Jobs;

use App\Mail\AdminChangePasswordMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class AdminChangePasswordJob implements ShouldQueue{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    /**
     * 
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user){
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){
        if(env('MAIL_ACCESS') == true) {
            $user = new AdminChangePasswordMail($this->user);
            Mail::to($this->user['email'])->send($user);
        }
    }
}