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
                "id" => 1,
                "user" => 1,
                "shirt" => "L",
                "pants" => "M",
                "shoes" => 39.5,
                "created_at" => now()->subMonths(12),
                "updated_at" => now()->subMonths(12)
            ],
            [
                "id" => 2,
                "user" => 2,
                "shirt" => "XL",
                "pants" => "L",
                "shoes" => 40.0,
                "created_at" => now()->subMonths(11),
                "updated_at" => now()->subMonths(11)
            ],
            [
                "id" => 3,
                "user" => 3,
                "shirt" => "M",
                "pants" => "M",
                "shoes" => 41.0,
                "created_at" => now()->subMonths(10),
                "updated_at" => now()->subMonths(10)
            ],
            [
                "id" => 4,
                "user" => 4,
                "shirt" => "L",
                "pants" => "XL",
                "shoes" => 42.5,
                "created_at" => now()->subMonths(9),
                "updated_at" => now()->subMonths(9)
            ],
            [
                "id" => 5,
                "user" => 5,
                "shirt" => "XL",
                "pants" => "L",
                "shoes" => 40.5,
                "created_at" => now()->subMonths(8),
                "updated_at" => now()->subMonths(8)
            ],
            [
                "id" => 6,
                "user" => 6,
                "shirt" => "3XL",
                "pants" => "XXL",
                "shoes" => 43.0,
                "created_at" => now()->subMonths(7),
                "updated_at" => now()->subMonths(7)
            ],
            [
                "id" => 7,
                "user" => 7,
                "shirt" => "M",
                "pants" => "M",
                "shoes" => 38.5,
                "created_at" => now()->subMonths(6),
                "updated_at" => now()->subMonths(6)
            ],
            [
                "id" => 8,
                "user" => 8,
                "shirt" => "L",
                "pants" => "L",
                "shoes" => 41.5,
                "created_at" => now()->subMonths(5),
                "updated_at" => now()->subMonths(5)
            ],
            [
                "id" => 9,
                "user" => 9,
                "shirt" => "XL",
                "pants" => "XL",
                "shoes" => 42.0,
                "created_at" => now()->subMonths(4),
                "updated_at" => now()->subMonths(4)
            ],
            [
                "id" => 10,
                "user" => 10,
                "shirt" => "L",
                "pants" => "L",
                "shoes" => 40.0,
                "created_at" => now()->subMonths(3),
                "updated_at" => now()->subMonths(3)
            ]       

            ]);
    }
}
