<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            [
                "id" => 1,
                'name' => 'Test1',
                'email' => 'a@gmail.com',
                "phone" => "000000000",
                "role" => "professional",
                "center" => "1",
                "status" => "active",
                "password" => Hash::make("123456"),
                'locker' => "T-123458",
                'locker_password' => '1234' 
            ],
            [
                "id" => 2,
                'name' => 'Test2',
                'email' => 'b@gmail.com',
                "phone" => "000000000",
                "role" => "professional",
                "center" => "1",
                "status" => "active",
                "password" => Hash::make("123456"),
                'locker' => "T-123457",
                'locker_password' => '1234'
            ],
            [
                "id" => 3,
                'name' => 'Test3',
                'email' => 'c@gmail.com',
                "phone" => "000000000",
                "role" => "professional",
                "center" => "1",
                "status" => "active",
                "password" => Hash::make("123456"),
                'locker' => "T-123456",
                'locker_password' => '1234'
            ],
            [
                "id" => 4,
                'name' => 'Test3',
                'email' => 'd@gmail.com',
                "phone" => "000000000",
                "role" => "professional",
                "center" => "1",
                "status" => "active",
                "password" => Hash::make("123456"),
                'locker' => "T-123456",
                'locker_password' => '1234'
            ],
            [
                "id" => 5,
                'name' => 'Test3',
                'email' => 'e@gmail.com',
                "phone" => "000000000",
                "role" => "professional",
                "center" => "1",
                "status" => "active",
                "password" => Hash::make("123456"),
                'locker' => "T-123456",
                'locker_password' => '1234'
            ]

        ]);
    }
}
