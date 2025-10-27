<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("courses")->insert([
                [
                    "id" => 1,
                    "center_id" => 1,
                    "name" => "Curso test 1",
                    "codiForcem" => "TEST",
                    "hours" => 20.2,
                    "type" => "FORMACION INTERNA",
                    "modality" => "PRESENCIAL",
                    "is_active" => true,
                    
                    "start_date" => now(),
                    "end_date" => now(),
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "id" => 2,
                    "center_id" => 1,
                    "name" => "Curso test 2",
                    "codiForcem" => "TEST",
                    "hours" => 10,
                    "type" => "FORMACION EXTERNA",
                    "modality" => "PRESENCIAL",
                    "is_active" => true,
                    
                    "start_date" => now(),
                    "end_date" => now(),
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "id" => 3,
                    "center_id" => 1,
                    "name" => "Curso test 3",
                    "codiForcem" => "TEST",
                    "hours" => 32,
                    "type" => "FORMACION INTERNA",
                    "modality" => "PRESENCIAL",
                    "is_active" => true,
                    
                    "start_date" => now(),
                    "end_date" => now(),
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "id" => 4,
                    "center_id" => 1,
                    "name" => "Curso test 4",
                    "codiForcem" => "TEST",
                    "hours" => 25,
                    "type" => "FORMACION EXTERNA",
                    "modality" => "PRESENCIAL",
                    "is_active" => true,
                    
                    "start_date" => now(),
                    "end_date" => now(),
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    "id" => 5,
                    "center_id" => 1,
                    "name" => "Curso test 5",
                    "codiForcem" => "TEST",
                    "hours" => 23.3,
                    "type" => "FORMACION INTERNA",
                    "modality" => "PRESENCIAL",
                    "is_active" => true,
                    
                    "start_date" => now(),
                    "end_date" => now(),
                    "created_at" => now(),
                    "updated_at" => now()
                ],
            ]
        );
    }
}
