<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create( [
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'display_name' => 'Administrator',
            'email' => 'admin@zalfrombanaras.com',
            'mobile' => '8989898989',
            'password' => \Hash::make('Zal@123456'),
            'remember_token' => \Str::random(10),
        ]);
        $admin->assignRole('admin');
        $admin2 = Admin::create( [
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'display_name' => 'Administrator',
            'email' => 'admin@vikas.com',
            'mobile' => '7000020625',
            'password' => \Hash::make('Vik@s123'),
            'remember_token' => \Str::random(10),
        ]);
        $admin2->assignRole('admin');

        $users = [
            [
                'first_name' => 'John',
                'last_name' => 'Deo',
                'display_name' => 'JohnDeo',
                'username' => 'john',
                'email' => 'john@gmail.com',
                'mobile' => '8989898988',
                'password' => \Hash::make('123456789'),
                'remember_token' => \Str::random(10),
                'type' => 'customer',
                'status' => '1'
            ],
            [
                'first_name' => 'Daniel',
                'last_name' => 'Smith',
                'display_name' => 'DanielSmith',
                'username' => 'daniel',
                'email' => 'daniel@gmail.com',
                'mobile' => '8989898978',
                'password' => \Hash::make('123456789'),
                'remember_token' => \Str::random(10),
                'type' => 'guest',
                'status' => '0'
            ],
            [
                'first_name' => 'Martin',
                'last_name' => 'Anderson',
                'display_name' => 'MartinAnderson',
                'username' => 'Martin',
                'email' => 'martin@gmail.com',
                'mobile' => '8989898852',
                'password' => \Hash::make('123456789'),
                'remember_token' => \Str::random(10),
                'type' => 'guest',
                'status' => '0'
            ],
            [
                'first_name' => 'Brown',
                'last_name' => 'Taylor',
                'display_name' => 'BrownTaylor',
                'username' => 'Taylor',
                'email' => 'taylor@gmail.com',
                'mobile' => '8989898845',
                'password' => \Hash::make('123456789'),
                'remember_token' => \Str::random(10),
                'type' => 'customer',
                'status' => '1'
            ],
            [
                'first_name' => 'Williams',
                'last_name' => 'Anderson',
                'display_name' => 'WilliamsAnderson',
                'username' => 'Williams',
                'email' => 'williams@gmail.com',
                'mobile' => '8989898123',
                'password' => \Hash::make('123456789'),
                'remember_token' => \Str::random(10),
                'type' => 'customer',
                'status' => '1'
            ]
        ];
        foreach ($users as $key => $user) {
            $user = User::create($user);
            $user->assignRole('user');
        }
    }
}