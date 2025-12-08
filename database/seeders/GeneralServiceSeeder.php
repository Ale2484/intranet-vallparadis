<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GeneralService;
use App\Models\Center;

class GeneralServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $center = Center::first();

        if ($center) {
            GeneralService::create([
                'center_id' => $center->id,
                'name' => 'Servei de Cuina',
                'type' => 'cuina',
                'manager_name' => 'Manager Cuina',
                'manager_email' => 'cuina@example.com',
                'manager_phone' => '111111111',
                'is_active' => true,
            ]);

            GeneralService::create([
                'center_id' => $center->id,
                'name' => 'Servei de Neteja',
                'type' => 'neteja',
                'manager_name' => 'Manager Neteja',
                'manager_email' => 'neteja@example.com',
                'manager_phone' => '222222222',
                'is_active' => true,
            ]);

            GeneralService::create([
                'center_id' => $center->id,
                'name' => 'Servei de Bugaderia',
                'type' => 'bugaderia',
                'manager_name' => 'Manager Bugaderia',
                'manager_email' => 'bugaderia@example.com',
                'manager_phone' => '333333333',
                'is_active' => true,
            ]);
        }
    }
}
