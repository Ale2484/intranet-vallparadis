<?php

namespace Database\Seeders;

use App\Models\User;
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
        $usersByCenter = User::all()->groupBy("center");

        foreach ($usersByCenter as $centerId => $usersInCenter) {
            if ($usersInCenter->count() > 1) {
                foreach ($usersInCenter as $user) {
                    $evaluator = $usersInCenter->where("id", "!=", $user->id)->random();
                    $evaluations[] = [
                        "user" => $user->id,
                        "evaluator" => $evaluator->id,
                        "comment" => "Avaluació de rendiment per a l'usuari " . $user->id . ".",
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
            }
        }

        DB::table("evaluations")->insert($evaluations);
    }
}
