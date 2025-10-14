<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("projects")->insert([
            [
                'center' => 1,
                'name' => 'proyecto 1',
                'start' => now(),
                'user' => 1,
                'description' => 'nose que.',
                'observations' => 'manolo.',
                'is_active' => true,
                'type' => 'Comissió',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'center' => 2,
                'name' => 'proyecto 2',
                'start' => now(),
                'user' => 2,
                'description' => 'nose que.',
                'observations' => 'manolo.',
                'is_active' => true,
                'type' => 'Projecte',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'center' => 3,
                'name' => 'proyecto 3',
                'start' => now(),
                'user' => 3,
                'description' => 'nose que.',
                'observations' => 'manolo.',
                'is_active' => true,
                'type' => 'Projecte',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'center' => 4,
                'name' => 'proyecto 4',
                'start' => now(),
                'user' => 4,
                'description' => 'nose que.',
                'observations' => 'manolo.',
                'is_active' => true,
                'type' => 'Projecte',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'center' => 5,
                'name' => 'proyecto 5',
                'start' => now(),
                'user' => 5,
                'description' => 'nose que.',
                'observations' => 'manolo.',
                'is_active' => true,
                'type' => 'Projecte',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
