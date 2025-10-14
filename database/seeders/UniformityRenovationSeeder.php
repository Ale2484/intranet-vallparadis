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
                "renewal_date" => now(),
                "delivered_by" => 3,
                "file" => "renovation1.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 2,
                "renewal_date" => now(),
                "delivered_by" => 4,
                "file" => "renovation1.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 3,
                "renewal_date" => now(),
                "delivered_by" => 5,
                "file" => "renovation1.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 4,
                "renewal_date" => now(),
                "delivered_by" => 1,
                "file" => "renovation1.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "uniformity_id" => 5,
                "renewal_date" => now(),
                "delivered_by" => 2,
                "file" => "renovation1.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ],
        ]);

    }
}
