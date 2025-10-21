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
                "user" => 1,
                "shirt" => "46",
                "pants" => "40",
                "shoes" => 40.2,
                "created_at" => now(),
                "updated_at" => now()

            ],
            [
                "user" => 2,
                "shirt" => "L",
                "pants" => "XL",
                "shoes" => 40.2,
                "created_at" => now(),
                "updated_at" => now()

            ],
            [
                "user" => 3,
                "shirt" => "L",
                "pants" => "XL",
                "shoes" => 40.2,
                "created_at" => now(),
                "updated_at" => now()

            ],
            [
                "user" => 4,
                "shirt" => "L",
                "pants" => "XL",
                "shoes" => 40.2,
                "created_at" => now(),
                "updated_at" => now()

            ],
            [
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
