<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::table("centers")->insert([
            [
                "id" => 1,
                "name" => "Centro1",
                "address" => "Calle 1",
                "phone" => "000000000",
                "created_at" => now(),
                "updated_at" => now()
            ]
            ]);
    }
}
