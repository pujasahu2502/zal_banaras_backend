<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class OrderDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:update';

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
        $allOrder = Order::with('orderItems')/*->where("id",5744)*/->get();
        foreach ($allOrder as $key => $order) {
            $order->orderItems()->update(["created_at" => $order["created_at"] ]);
            $this->info($key.','.$order["order_id"]);
        }
        $this->info("Order Item Date Update");
        // return 0;
    }

}
