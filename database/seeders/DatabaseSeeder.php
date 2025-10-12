<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CenterSeeder::class,
            UserSeeder::class,
            UniformitySeeder::class,
            UniformityRenovationSeeder::class

        ]);
        // User::factory(10)->create();
    }
}
