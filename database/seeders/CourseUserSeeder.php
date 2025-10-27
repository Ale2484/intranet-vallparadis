<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CourseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("course_users")->insert([
                [
                    "id" => 1,
                    "user_id" => 1,
                    "course_id" => 1,

                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "id" => 2,
                    "user_id" => 2,
                    "course_id" => 1,

                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "id" => 3,
                    "user_id" => 3,
                    "course_id" => 1,

                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "id" => 4,
                    "user_id" => 4,
                    "course_id" => 1,

                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "id" => 5,
                    "user_id" => 5,
                    "course_id" => 1,

                    "created_at" => now(),
                    "updated_at" => now()
                ],
            ]
        );
    }
}
