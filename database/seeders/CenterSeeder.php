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
                    "email" => "e",
                    "address" => "Calle 1",
                    "phone" => "000000000",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "id" => 2,
                    "name" => "Centro2",
                    "email" => "a",
                    "address" => "Calle 1",
                    "phone" => "000000000",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "id" => 3,
                    "name" => "Centro3",
                    "email" => "b",
                    "address" => "Calle 1",
                    "phone" => "000000000",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "id" => 4,
                    "name" => "Centro4",
                    "email" => "c",
                    "address" => "Calle 1",
                    "phone" => "000000000",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "id" => 5,
                    "name" => "Centro5",
                    "email" => "d",
                    "address" => "Calle 1",
                    "phone" => "000000000",
                    "created_at" => now(),
                    "updated_at" => now()
                ],
            ]
        );
    }
}
