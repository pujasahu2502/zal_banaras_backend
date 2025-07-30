<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            // Reset cached roles and permissions
            app()['cache']->forget('spatie.permission.cache');
            
            /* ================ Created Permission =============== */
            $permissions = [
                // this is for User
                ['name' => 'list-user'],
                ['name' => 'show-user'],
                ['name' => 'create-user'],
                ['name' => 'store-user'],
                ['name' => 'edit-user'],
                ['name' => 'update-user'],
                ['name' => 'status-user'],
                ['name' => 'delete-user'],
                ['name' => 'user-proxy'],

                // this is for Category
                ['name' => 'list-category'],
                ['name' => 'create-category'],
                ['name' => 'store-category'],
                ['name' => 'edit-category'],
                ['name' => 'update-category'],
                ['name' => 'status-category'],
                ['name' => 'delete-category'],

                // this is for Attribute
                ['name' => 'list-attribute'],
                ['name' => 'create-attribute'],
                ['name' => 'store-attribute'],
                ['name' => 'edit-attribute'],
                ['name' => 'update-attribute'],
                ['name' => 'status-attribute'],
                ['name' => 'delete-attribute'],

                // this is for Variation
                ['name' => 'list-variation'],
                ['name' => 'create-variation'],
                ['name' => 'store-variation'],
                ['name' => 'edit-variation'],
                ['name' => 'update-variation'],
                ['name' => 'status-variation'],
                ['name' => 'delete-variation'],

                // this is for product
                ['name'=>'list-product'],
                ['name'=>'create-product'],
                ['name'=>'store-product'],
                ['name'=>'edit-product'],
                ['name'=>'update-product'],
                ['name'=>'destroy-product'],
                ['name'=>'productStatus-product'],

                // this is for change password
                ['name' => 'view-change-password'],
                ['name' => 'store-change-password'],

                // this is for contact us
                ['name' => 'show-contact-us'],
                ['name' => 'list-contact-us'],

                // this is for gift card
                ['name'=>'list-gift-card'],
                ['name'=>'create-gift-card'],
                ['name'=>'edit-gift-card'],
                ['name'=>'update-gift-card'],
                ['name'=>'destroy-gift-card'],
                ['name'=>'status-gift-card'],

                // this is for webinar
                ['name'=>'list-webinar'],
                ['name'=>'create-webinar'],
                ['name'=>'store-webinar'],
                ['name'=>'edit-webinar'],
                ['name'=>'update-webinar'],
                ['name'=>'destroy-webinar'],
                ['name'=>'webinarStatus-webinar'],

                // this is for booking
                ['name'=>'list-booking'],
                ['name'=>'detail-booking'],
                ['name'=>'pdf-booking'],

                // this is for transaction
                ['name'=>'list-transaction'],

                // this is for subscription
                ['name'=>'list-subscription'],

                // this is for pages
                ['name'=>'list-page'],
                ['name'=>'edit-page'],
                ['name'=>'update-page'],
                ['name'=>'status-page'],

                // this is for faq
                ['name'=>'list-faq'],
                ['name'=>'create-faq'],
                ['name'=>'store-faq'],
                ['name'=>'edit-faq'],
                ['name'=>'update-faq'],
                ['name'=>'destroy-faq'],
                ['name'=>'status-faq']
            ];
    
            foreach ($permissions as $permission) {
                // check first time create otherwise update
                Permission::Create([
                    'name' => $permission['name'],
                    'guard_name' => 'admin'
                ]);
            }
            // get admin role 
            $adminRole = Role::where('name','admin')->first();
            
            //ASSIGN PERMISSIONS TO ADMIN
            $adminRole->givePermissionTo(Permission::where('guard_name','admin')->get());
        }
    }
}