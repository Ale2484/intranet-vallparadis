<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RrhhTopicSeeder extends Seeder
{
    public function run(): void
    {
        $topics = [
            'Horario',
            'Vacaciones',
            'Conflicto laboral',
            'Cambio de puesto',
            'Baja médica',
            'Formación'
        ];

        $derivatives = [
            'Departamento de RRHH',
            'Dirección',
            'Mediación',
            'Prevención de riesgos'
        ];

        $data = [];

        for ($i = 1; $i <= 5; $i++) {
            $data[] = [
                'center' => $i,
                'opening' => rand(0, 1) ? Carbon::now()->subDays(rand(1, 30)) : null,
                'user_affected' => $i,
                'description' => "Incidencia RRHH número {$i}",
                'user_register' => $i+9,
                'derivative' => $derivatives[array_rand($derivatives)],
                'topic' => $topics[array_rand($topics)],
                'is_active' => $i % 5 !== 0,
                'created_at' => Carbon::now()->subDays(rand(1, 90)),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('rrhh_topics')->insert($data);
    }
}
