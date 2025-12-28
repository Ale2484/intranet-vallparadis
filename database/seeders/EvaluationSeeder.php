<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $evaluations = [];
        for ($i = 1; $i <= 30; $i++) {
            // Se evaluan a todos los usuarios con el usuario con el ID 3 y cuando se evalua al usuario con ID 3 se usa el ID de usuario 4
            $evaluatorId = ($i === 3) ? 4 : 3;
            $evaluations[] = [
                "user" => $i,
                "evaluator" => $evaluatorId,
                "comment" => "Avaluació de rendiment per a l'usuari " . $i . ".",
                "p1" => rand(1, 3),
                "p2" => rand(1, 3),
                "p3" => rand(1, 3),
                "p4" => rand(1, 3),
                "p5" => rand(1, 3),
                "p6" => rand(1, 3),
                "p7" => rand(1, 3),
                "p8" => rand(1, 3),
                "p9" => rand(1, 3),
                "p10" => rand(1, 3),
                "p11" => rand(1, 3),
                "p12" => rand(1, 3),
                "p13" => rand(1, 3),
                "p14" => rand(1, 3),
                "p15" => rand(1, 3),
                "p16" => rand(1, 3),
                "p17" => rand(1, 3),
                "p18" => rand(1, 3),
                "p19" => rand(1, 3),
                "p20" => rand(1, 3),
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }

        DB::table("evaluations")->insert($evaluations);
    }
}
