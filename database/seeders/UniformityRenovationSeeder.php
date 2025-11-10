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
                "shirt_renewal" => "XXL",
                "pants_renewal" => "XXL",
                "shoes_renewal" => 40.5,
                "file" => "renovation1.pdf",
                "created_at" => now(),
                "updated_at" => now()
            ]
        ]);

    }
}
