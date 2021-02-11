<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin User
        $admin = User::create([
            'name'              => 'Site Admin',
            'email'             => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('password'), 
            'remember_token'    => Str::random(10),
            'is_admin'          => 1,
            'plan_name'         => '',
            'left_points'       => 0,
            'expired_at'        => null,
        ]);

        // Demo User 1
        $user1 = User::create([
            'name'              => 'Demo User 1',
            'email'             => 'demo.user1@gmail.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('password'), 
            'remember_token'    => Str::random(10),
            'is_admin'          => 0,
            'plan_name'         => '',
            'left_points'       => 0,
            'expired_at'        => null,
        ]);

        // Demo User 2
        $user2 = User::create([
            'name'              => 'Demo User 2',
            'email'             => 'demo.user2@gmail.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('password'), 
            'remember_token'    => Str::random(10),
            'is_admin'          => 0,
            'plan_name'         => '',
            'left_points'       => 0,
            'expired_at'        => null,
        ]);

        // // Demo User 3
        // $user3 = User::create([
        //     'name'              => 'Demo User 3',
        //     'email'             => 'demo.user3@gmail.com',
        //     'email_verified_at' => now(),
        //     'password'          => bcrypt('password'), 
        //     'remember_token'    => Str::random(10),
        //     'is_admin'          => 0
        // ]);
    }
}
