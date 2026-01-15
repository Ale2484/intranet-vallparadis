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
                "renewal_date" => "2024-01-15",
                "delivered_by" => 1,
                "shirt_renewal" => "M",
                "pants_renewal" => "L",
                "shoes_renewal" => 40.0,
                "file" => "renovation1.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 1,
                "renewal_date" => "2026-07-15",
                "delivered_by" => 1,
                "shirt_renewal" => "L",
                "pants_renewal" => "L",
                "shoes_renewal" => 40.0,
                "file" => "renovation1_2.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 2,
                "renewal_date" => "2024-02-20",
                "delivered_by" => 2,
                "shirt_renewal" => "L",
                "pants_renewal" => "XL",
                "shoes_renewal" => 41.0,
                "file" => "renovation2.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 2,
                "renewal_date" => "2026-08-20",
                "delivered_by" => 2,
                "shirt_renewal" => "L",
                "pants_renewal" => "XXL",
                "shoes_renewal" => 41.0,
                "file" => "renovation2_2.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 3,
                "renewal_date" => "2024-03-10",
                "delivered_by" => 3,
                "shirt_renewal" => "S",
                "pants_renewal" => "M",
                "shoes_renewal" => 38.5,
                "file" => "renovation3.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 4,
                "renewal_date" => "2024-04-05",
                "delivered_by" => 4,
                "shirt_renewal" => "XL",
                "pants_renewal" => "XXL",
                "shoes_renewal" => 43.0,
                "file" => "renovation4.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 5,
                "renewal_date" => "2024-05-22",
                "delivered_by" => 5,
                "shirt_renewal" => "M",
                "pants_renewal" => "L",
                "shoes_renewal" => 39.0,
                "file" => "renovation5.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 6,
                "renewal_date" => "2024-06-18",
                "delivered_by" => 6,
                "shirt_renewal" => "L",
                "pants_renewal" => "XL",
                "shoes_renewal" => 42.5,
                "file" => "renovation6.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 7,
                "renewal_date" => "2024-07-30",
                "delivered_by" => 7,
                "shirt_renewal" => "S",
                "pants_renewal" => "S",
                "shoes_renewal" => 37.0,
                "file" => "renovation7.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 8,
                "renewal_date" => "2024-08-01",
                "delivered_by" => 8,
                "shirt_renewal" => "XXL",
                "pants_renewal" => "3XL",
                "shoes_renewal" => 44.0,
                "file" => "renovation8.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 9,
                "renewal_date" => "2024-09-11",
                "delivered_by" => 9,
                "shirt_renewal" => "M",
                "pants_renewal" => "M",
                "shoes_renewal" => 40.5,
                "file" => "renovation9.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 10,
                "renewal_date" => "2024-10-25",
                "delivered_by" => 10,
                "shirt_renewal" => "L",
                "pants_renewal" => "L",
                "shoes_renewal" => 41.5,
                "file" => "renovation10.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 11,
                "renewal_date" => "2024-11-03",
                "delivered_by" => 11,
                "shirt_renewal" => "XL",
                "pants_renewal" => "XL",
                "shoes_renewal" => 42.0,
                "file" => "renovation11.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 12,
                "renewal_date" => "2024-12-07",
                "delivered_by" => 12,
                "shirt_renewal" => "S",
                "pants_renewal" => "M",
                "shoes_renewal" => 39.0,
                "file" => "renovation12.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 13,
                "renewal_date" => "2025-01-02",
                "delivered_by" => 13,
                "shirt_renewal" => "M",
                "pants_renewal" => "L",
                "shoes_renewal" => 40.5,
                "file" => "renovation13.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 14,
                "renewal_date" => "2025-02-14",
                "delivered_by" => 14,
                "shirt_renewal" => "L",
                "pants_renewal" => "XL",
                "shoes_renewal" => 41.0,
                "file" => "renovation14.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 15,
                "renewal_date" => "2025-03-21",
                "delivered_by" => 15,
                "shirt_renewal" => "XL",
                "pants_renewal" => "XXL",
                "shoes_renewal" => 43.5,
                "file" => "renovation15.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 16,
                "renewal_date" => "2025-04-08",
                "delivered_by" => 16,
                "shirt_renewal" => "S",
                "pants_renewal" => "S",
                "shoes_renewal" => 36.5,
                "file" => "renovation16.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 17,
                "renewal_date" => "2025-05-19",
                "delivered_by" => 17,
                "shirt_renewal" => "M",
                "pants_renewal" => "L",
                "shoes_renewal" => 40.0,
                "file" => "renovation17.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 18,
                "renewal_date" => "2025-06-28",
                "delivered_by" => 18,
                "shirt_renewal" => "L",
                "pants_renewal" => "XL",
                "shoes_renewal" => 42.0,
                "file" => "renovation18.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 19,
                "renewal_date" => "2025-07-17",
                "delivered_by" => 19,
                "shirt_renewal" => "XL",
                "pants_renewal" => "XXL",
                "shoes_renewal" => 43.0,
                "file" => "renovation19.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 20,
                "renewal_date" => "2025-08-09",
                "delivered_by" => 20,
                "shirt_renewal" => "S",
                "pants_renewal" => "M",
                "shoes_renewal" => 38.0,
                "file" => "renovation20.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 21,
                "renewal_date" => "2025-09-01",
                "delivered_by" => 21,
                "shirt_renewal" => "M",
                "pants_renewal" => "L",
                "shoes_renewal" => 40.0,
                "file" => "renovation21.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 22,
                "renewal_date" => "2025-10-10",
                "delivered_by" => 22,
                "shirt_renewal" => "L",
                "pants_renewal" => "XL",
                "shoes_renewal" => 41.0,
                "file" => "renovation22.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 23,
                "renewal_date" => "2025-11-20",
                "delivered_by" => 23,
                "shirt_renewal" => "XL",
                "pants_renewal" => "XXL",
                "shoes_renewal" => 43.0,
                "file" => "renovation23.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 24,
                "renewal_date" => "2025-12-05",
                "delivered_by" => 24,
                "shirt_renewal" => "S",
                "pants_renewal" => "S",
                "shoes_renewal" => 37.0,
                "file" => "renovation24.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 25,
                "renewal_date" => "2026-01-12",
                "delivered_by" => 25,
                "shirt_renewal" => "M",
                "pants_renewal" => "L",
                "shoes_renewal" => 40.0,
                "file" => "renovation25.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 26,
                "renewal_date" => "2026-02-28",
                "delivered_by" => 26,
                "shirt_renewal" => "L",
                "pants_renewal" => "XL",
                "shoes_renewal" => 41.0,
                "file" => "renovation26.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 27,
                "renewal_date" => "2026-03-17",
                "delivered_by" => 27,
                "shirt_renewal" => "XL",
                "pants_renewal" => "XXL",
                "shoes_renewal" => 43.0,
                "file" => "renovation27.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 28,
                "renewal_date" => "2026-04-04",
                "delivered_by" => 28,
                "shirt_renewal" => "S",
                "pants_renewal" => "M",
                "shoes_renewal" => 38.0,
                "file" => "renovation28.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 29,
                "renewal_date" => "2026-05-15",
                "delivered_by" => 29,
                "shirt_renewal" => "M",
                "pants_renewal" => "L",
                "shoes_renewal" => 40.0,
                "file" => "renovation29.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 30,
                "renewal_date" => "2026-06-20",
                "delivered_by" => 30,
                "shirt_renewal" => "L",
                "pants_renewal" => "XL",
                "shoes_renewal" => 41.0,
                "file" => "renovation30.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ]
        ]);
    }
}