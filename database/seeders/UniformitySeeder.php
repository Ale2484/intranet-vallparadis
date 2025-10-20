<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UniformitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("uniformities")->insert([
            [
                "user_delivery" => 2,
                "user" => 1,
                "shirt" => "46",
                "pants" => "40",
                "shoes" => 40.2,
                "created_at" => now(),
                "updated_at" => now()

            ],
            [
                "user_delivery" => 3,
                "user" => 2,
                "shirt" => "L",
                "pants" => "XL",
                "shoes" => 40.2,
                "created_at" => now(),
                "updated_at" => now()

            ],
            [
                "user_delivery" => 4,
                "user" => 3,
                "shirt" => "L",
                "pants" => "XL",
                "shoes" => 40.2,
                "created_at" => now(),
                "updated_at" => now()

            ],
            [
                "user_delivery" => 5,
                "user" => 4,
                "shirt" => "L",
                "pants" => "XL",
                "shoes" => 40.2,
                "created_at" => now(),
                "updated_at" => now()

            ],
            [
                "user_delivery" => 1,
                "user" => 5,
                "shirt" => "L",
                "pants" => "XL",
                "shoes" => 40.2,
                "created_at" => now(),
                "updated_at" => now()

            ],            

            ]);
    }
}
