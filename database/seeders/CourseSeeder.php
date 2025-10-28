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
                    "type" => "Formació interna",
                    "modality" => "Presencial",
                    "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima expedita ab cum sed ipsam, magni consequuntur atque veniam exercitationem unde sapiente eius totam animi dicta cumque nisi! Atque, pariatur dicta?",
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
                    "type" => "Formació externa",
                    "modality" => "Presencial",
                    "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima expedita ab cum sed ipsam, magni consequuntur atque veniam exercitationem unde sapiente eius totam animi dicta cumque nisi! Atque, pariatur dicta?",
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
                    "type" => "Formació interna",
                    "modality" => "Presencial",
                    "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima expedita ab cum sed ipsam, magni consequuntur atque veniam exercitationem unde sapiente eius totam animi dicta cumque nisi! Atque, pariatur dicta?",
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
                    "type" => "Formació externa",
                    "modality" => "Presencial",
                    "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima expedita ab cum sed ipsam, magni consequuntur atque veniam exercitationem unde sapiente eius totam animi dicta cumque nisi! Atque, pariatur dicta?",
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
                    "type" => "Formació interna",
                    "modality" => "Presencial",
                    "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima expedita ab cum sed ipsam, magni consequuntur atque veniam exercitationem unde sapiente eius totam animi dicta cumque nisi! Atque, pariatur dicta?",
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
