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
                "start_time" => "08:00",
                "end_time" => "09:30"
            ],
            [
                "course_id" => 1,
                "day_of_week" => "Dimecres",
                "start_time" => "08:00",
                "end_time" => "09:30"
            ],
            [
                "course_id" => 2,
                "day_of_week" => "Dimarts",
                "start_time" => "10:00",
                "end_time" => "12:00"
            ],
            [
                "course_id" => 2,
                "day_of_week" => "Dijous",
                "start_time" => "10:00",
                "end_time" => "12:00"
            ],
            [
                "course_id" => 3,
                "day_of_week" => "Dilluns",
                "start_time" => "14:00",
                "end_time" => "16:00"
            ],
            [
                "course_id" => 3,
                "day_of_week" => "Divendres",
                "start_time" => "14:00",
                "end_time" => "16:00"
            ],
            [
                "course_id" => 4,
                "day_of_week" => "Dimarts",
                "start_time" => "09:00",
                "end_time" => "11:00"
            ],
            [
                "course_id" => 4,
                "day_of_week" => "Dijous",
                "start_time" => "09:00",
                "end_time" => "11:00"
            ],
            [
                "course_id" => 5,
                "day_of_week" => "Dimecres",
                "start_time" => "08:30",
                "end_time" => "10:00"
            ],
            [
                "course_id" => 5,
                "day_of_week" => "Divendres",
                "start_time" => "08:30",
                "end_time" => "10:00"
            ],
            [
                "course_id" => 6,
                "day_of_week" => "Dilluns",
                "start_time" => "10:00",
                "end_time" => "11:30"
            ],
            [
                "course_id" => 6,
                "day_of_week" => "Dimecres",
                "start_time" => "10:00",
                "end_time" => "11:30"
            ],
            [
                "course_id" => 7,
                "day_of_week" => "Dimarts",
                "start_time" => "15:00",
                "end_time" => "16:30"
            ],
            [
                "course_id" => 7,
                "day_of_week" => "Dijous",
                "start_time" => "15:00",
                "end_time" => "16:30"
            ],
            [
                "course_id" => 8,
                "day_of_week" => "Dilluns",
                "start_time" => "09:00",
                "end_time" => "10:30"
            ],
            [
                "course_id" => 8,
                "day_of_week" => "Divendres",
                "start_time" => "09:00",
                "end_time" => "10:30"
            ],
            [
                "course_id" => 9,
                "day_of_week" => "Dimarts",
                "start_time" => "11:00",
                "end_time" => "12:30"
            ],
            [
                "course_id" => 9,
                "day_of_week" => "Dijous",
                "start_time" => "11:00",
                "end_time" => "12:30"
            ],
            [
                "course_id" => 10,
                "day_of_week" => "Dimecres",
                "start_time" => "13:00",
                "end_time" => "14:30"
            ],
            [
                "course_id" => 10,
                "day_of_week" => "Divendres",
                "start_time" => "13:00",
                "end_time" => "14:30"
            ]

        ]);

    }
}
