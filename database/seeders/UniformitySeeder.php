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
                "shirt" => "L",
                "pants" => "L",
                "shoes" => 40.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 2,
                "shirt" => "L",
                "pants" => "XXL",
                "shoes" => 41.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 3,
                "shirt" => "S",
                "pants" => "M",
                "shoes" => 38.5,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 4,
                "shirt" => "XL",
                "pants" => "XXL",
                "shoes" => 43.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 5,
                "shirt" => "M",
                "pants" => "L",
                "shoes" => 39.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 6,
                "shirt" => "L",
                "pants" => "XL",
                "shoes" => 42.5,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 7,
                "shirt" => "S",
                "pants" => "S",
                "shoes" => 37.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 8,
                "shirt" => "XXL",
                "pants" => "3XL",
                "shoes" => 44.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 9,
                "shirt" => "M",
                "pants" => "M",
                "shoes" => 40.5,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 10,
                "shirt" => "L",
                "pants" => "L",
                "shoes" => 41.5,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 11,
                "shirt" => "XL",
                "pants" => "XL",
                "shoes" => 42.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 12,
                "shirt" => "S",
                "pants" => "M",
                "shoes" => 39.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 13,
                "shirt" => "M",
                "pants" => "L",
                "shoes" => 40.5,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 14,
                "shirt" => "L",
                "pants" => "XL",
                "shoes" => 41.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 15,
                "shirt" => "XL",
                "pants" => "XXL",
                "shoes" => 43.5,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 16,
                "shirt" => "S",
                "pants" => "S",
                "shoes" => 36.5,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 17,
                "shirt" => "M",
                "pants" => "L",
                "shoes" => 40.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 18,
                "shirt" => "L",
                "pants" => "XL",
                "shoes" => 42.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 19,
                "shirt" => "XL",
                "pants" => "XXL",
                "shoes" => 43.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 20,
                "shirt" => "S",
                "pants" => "M",
                "shoes" => 38.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 21,
                "shirt" => "M",
                "pants" => "L",
                "shoes" => 40.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 22,
                "shirt" => "L",
                "pants" => "XL",
                "shoes" => 41.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 23,
                "shirt" => "XL",
                "pants" => "XXL",
                "shoes" => 43.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 24,
                "shirt" => "S",
                "pants" => "S",
                "shoes" => 37.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 25,
                "shirt" => "M",
                "pants" => "L",
                "shoes" => 40.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 26,
                "shirt" => "L",
                "pants" => "XL",
                "shoes" => 41.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 27,
                "shirt" => "XL",
                "pants" => "XXL",
                "shoes" => 43.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 28,
                "shirt" => "S",
                "pants" => "M",
                "shoes" => 38.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 29,
                "shirt" => "M",
                "pants" => "L",
                "shoes" => 40.0,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "user" => 30,
                "shirt" => "L",
                "pants" => "XL",
                "shoes" => 41.0,
                "created_at" => now(),
                "updated_at" => now()
            ]
        ]);
    }
}