<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Create roles */
        $roles = [
            ['name' => 'admin','guard_name' => 'admin'],
            ['name' => 'user','guard_name' => 'web'],
        ];
       
        /**
          * insert in roles table
          * @param $roles array 
          */ 

        foreach ($roles as $role) {
            // check first time create otherwise update
            Role::Create([
                'name' => $role['name'],
                'guard_name' => $role['guard_name'],
            ]);
        } 
    }
}