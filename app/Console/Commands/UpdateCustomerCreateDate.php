<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\User;
use Illuminate\Console\Command;

class UpdateCustomerCreateDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:guest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $allGuest = User::where('type','customer')->get();
        foreach ($allGuest as $key => $guest) {
            // dd($guest);
            $date = null; 
            if($guest->type == 'customer') {
                $date = Order::where('user_id', $guest['id'])->first()->created_at ?? \Carbon\Carbon::parse('Now -300 days');
            }else{
                $date = Order::where('user_id', $guest['id'])->first()->created_at;
            }
            $date = (\Carbon\Carbon::parse($date)->toDateTimeString());
            $guest->update(["created_at" => $date]);

            $this->info($key.', '.$guest['email'].', '.$date);
            // dd($guest);
        }
        $this->info('Guest Created Date Updated AT');
    }
}
