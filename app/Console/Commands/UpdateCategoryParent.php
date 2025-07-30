<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;


class UpdateCategoryParent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db-actions:update-category-parent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will update the category parent.';

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
        try{
            ini_set('max_execution_time', 0);
            
            $categoryArr = [
                'Game Reaper' => 1,
                'DnZ Apparel' => 2,
                '215 Tactical' => 1,
                'Uncategorized'=> 4,
                'Mounting Accessories'=> 2,
                'Quick Justice' => 4,
                'Freedom Reaper Picatinny Rails' => 4,
                'DnZ Apparel' => 4
            ];
            foreach($categoryArr as $key => $value){
                $checkCategory = Category::where([
                    'name' => $key
                ])->first();

                if($checkCategory){
                    $checkCategory->type = $value;
                    $checkCategory->save();
                }
            }
            $this->info('Category Parent updated successfully.');

        }catch (\Exception $ex) {
            \Log::error($ex);
            $this->error($ex->getMessage());
            return;
        }
    }
    
}
