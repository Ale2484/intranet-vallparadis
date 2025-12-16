<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MaintenanceSeeder extends Seeder
{
    public function run(): void
    {
        $topics = [
            'Electricidad',
            'Fontanería',
            'Climatización',
            'Iluminación',
            'Redes',
            'Seguridad'
        ];

        $responsibles = [
            'Juan Pérez',
            'Laura Gómez',
            'Carlos Ruiz',
            'Ana Torres',
            'Miguel Sánchez'
        ];

        $data = [];

        for ($i = 1; $i <= 22; $i++) {
            $data[] = [
                'center' => ($i % 2) + 1,
                'responsible' => $responsibles[array_rand($responsibles)],
                'description' => "Mantenimiento programado número {$i}",
                'topic' => $topics[array_rand($topics)],
                'is_active' => $i % 4 !== 0,
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('maintenances')->insert($data);
    }
}