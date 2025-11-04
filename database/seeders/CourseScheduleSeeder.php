<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CourseScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("course_schedules")->insert([
            [
                "course_id" => 1,
                "day_of_week" => "Dilluns",
                "start_time" => "8:00:00",
                "end_time" => "9:00:00"
            ],
            [
                "course_id" => 1,
                "day_of_week" => "Dimarts",
                "start_time" => "8:00:00",
                "end_time" => "9:00:00"
            ],
            [
                "course_id" => 1,
                "day_of_week" => "Dimecres",
                "start_time" => "8:00:00",
                "end_time" => "9:00:00"
            ],
            [
                "course_id" => 1,
                "day_of_week" => "Dijous",
                "start_time" => "8:00:00",
                "end_time" => "9:00:00"
            ],
            [
                "course_id" => 1,
                "day_of_week" => "Divendres",
                "start_time" => "8:00:00",
                "end_time" => "9:00:00"
            ]

        ]);

    }
}
