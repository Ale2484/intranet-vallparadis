<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UniformityRenovationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("uniformity_renovations")->insert([
            [
                "uniformity_id" => 1,
                "renewal_date" => now()->subMonths(12),
                "delivered_by" => 3,
                "shirt_renewal" => "L",
                "pants_renewal" => "M",
                "shoes_renewal" => 39.5,
                "file" => "renovation1.pdf",
                "created_at" => now()->subMonths(12),
                "updated_at" => now()->subMonths(12)
            ],
            [
                "uniformity_id" => 2,
                "renewal_date" => now()->subMonths(11),
                "delivered_by" => 1,
                "shirt_renewal" => "XL",
                "pants_renewal" => "L",
                "shoes_renewal" => 40.0,
                "file" => "renovation2.pdf",
                "created_at" => now()->subMonths(11),
                "updated_at" => now()->subMonths(11)
            ],
            [
                "uniformity_id" => 3,
                "renewal_date" => now()->subMonths(10),
                "delivered_by" => 2,
                "shirt_renewal" => "M",
                "pants_renewal" => "M",
                "shoes_renewal" => 41.0,
                "file" => "renovation3.pdf",
                "created_at" => now()->subMonths(10),
                "updated_at" => now()->subMonths(10)
            ],
            [
                "uniformity_id" => 4,
                "renewal_date" => now()->subMonths(9),
                "delivered_by" => 5,
                "shirt_renewal" => "L",
                "pants_renewal" => "XL",
                "shoes_renewal" => 42.5,
                "file" => "renovation4.pdf",
                "created_at" => now()->subMonths(9),
                "updated_at" => now()->subMonths(9)
            ],
            [
                "uniformity_id" => 5,
                "renewal_date" => now()->subMonths(8),
                "delivered_by" => 3,
                "shirt_renewal" => "XL",
                "pants_renewal" => "L",
                "shoes_renewal" => 40.5,
                "file" => "renovation5.pdf",
                "created_at" => now()->subMonths(8),
                "updated_at" => now()->subMonths(8)
            ],
            [
                "uniformity_id" => 6,
                "renewal_date" => now()->subMonths(7),
                "delivered_by" => 2,
                "shirt_renewal" => "3XL",
                "pants_renewal" => "XXL",
                "shoes_renewal" => 43.0,
                "file" => "renovation6.pdf",
                "created_at" => now()->subMonths(7),
                "updated_at" => now()->subMonths(7)
            ],
            [
                "uniformity_id" => 7,
                "renewal_date" => now()->subMonths(6),
                "delivered_by" => 1,
                "shirt_renewal" => "M",
                "pants_renewal" => "M",
                "shoes_renewal" => 38.5,
                "file" => "renovation7.pdf",
                "created_at" => now()->subMonths(6),
                "updated_at" => now()->subMonths(6)
            ],
            [
                "uniformity_id" => 8,
                "renewal_date" => now()->subMonths(5),
                "delivered_by" => 4,
                "shirt_renewal" => "L",
                "pants_renewal" => "L",
                "shoes_renewal" => 41.5,
                "file" => "renovation8.pdf",
                "created_at" => now()->subMonths(5),
                "updated_at" => now()->subMonths(5)
            ],
            [
                "uniformity_id" => 9,
                "renewal_date" => now()->subMonths(4),
                "delivered_by" => 3,
                "shirt_renewal" => "XL",
                "pants_renewal" => "XL",
                "shoes_renewal" => 42.0,
                "file" => "renovation9.pdf",
                "created_at" => now()->subMonths(4),
                "updated_at" => now()->subMonths(4)
            ],
            [
                "uniformity_id" => 10,
                "renewal_date" => now()->subMonths(3),
                "delivered_by" => 2,
                "shirt_renewal" => "L",
                "pants_renewal" => "L",
                "shoes_renewal" => 40.0,
                "file" => "renovation10.pdf",
                "created_at" => now()->subMonths(3),
                "updated_at" => now()->subMonths(3)
            ]
        ]);

    }
}
