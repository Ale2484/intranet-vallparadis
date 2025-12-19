<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ComplementaryServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("complementary_services")->insert([
            [
                "id" => 1,
                "center_id" => 1,
                "name" => "Psicologia",
                "type" => "Salud Mental",
                "manager_name" => "Dr. Pere Garcia",
                "manager_email" => "pere.garcia@example.com",
                "manager_phone" => "+34600111222",
                "schedules" => "Dilluns a Divendres 9:00-17:00",
                "is_active" => true,
                "created_at" => now()->subDays(20),
                "updated_at" => now()->subDays(19),
            ],
            [
                "id" => 2,
                "center_id" => 2,
                "name" => "Fisioteràpia",
                "type" => "Rehabilitació",
                "manager_name" => "Marta Soler",
                "manager_email" => "marta.soler@example.com",
                "manager_phone" => "+34600333444",
                "schedules" => "Dilluns, Dimecres, Divendres 10:00-14:00",
                "is_active" => true,
                "created_at" => now()->subDays(18),
                "updated_at" => now()->subDays(17),
            ],
            [
                "id" => 3,
                "center_id" => 3,
                "name" => "Logopèdia",
                "type" => "Teràpies",
                "manager_name" => "Anna Puig",
                "manager_email" => "anna.puig@example.com",
                "manager_phone" => "+34600555666",
                "schedules" => "Dimarts i Dijous 15:00-19:00",
                "is_active" => true,
                "created_at" => now()->subDays(16),
                "updated_at" => now()->subDays(15),
            ],
            [
                "id" => 4,
                "center_id" => 4,
                "name" => "Nutrició i Dietètica",
                "type" => "Salut",
                "manager_name" => "Carles Bosch",
                "manager_email" => "carles.bosch@example.com",
                "manager_phone" => "+34600777888",
                "schedules" => "Dilluns a Divendres 9:00-13:00",
                "is_active" => true,
                "created_at" => now()->subDays(14),
                "updated_at" => now()->subDays(13),
            ],
            [
                "id" => 5,
                "center_id" => 5,
                "name" => "Servei de Bugaderia",
                "type" => "Domèstic",
                "manager_name" => "Laura Roca",
                "manager_email" => "laura.roca@example.com",
                "manager_phone" => "+34600999000",
                "schedules" => "Cada dia 8:00-16:00",
                "is_active" => true,
                "created_at" => now()->subDays(12),
                "updated_at" => now()->subDays(11),
            ],
            [
                "id" => 6,
                "center_id" => 6,
                "name" => "Transport Adaptat",
                "type" => "Mobilitat",
                "manager_name" => "Jordi Rius",
                "manager_email" => "jordi.rius@example.com",
                "manager_phone" => "+34601111222",
                "schedules" => "A demanda",
                "is_active" => true,
                "created_at" => now()->subDays(10),
                "updated_at" => now()->subDays(9),
            ],
            [
                "id" => 7,
                "center_id" => 7,
                "name" => "Peluqueria",
                "type" => "Estètica",
                "manager_name" => "Sandra Vidal",
                "manager_email" => "sandra.vidal@example.com",
                "manager_phone" => "+34601333444",
                "schedules" => "Dimarts i Divendres 9:00-13:00",
                "is_active" => true,
                "created_at" => now()->subDays(8),
                "updated_at" => now()->subDays(7),
            ],
            [
                "id" => 8,
                "center_id" => 8,
                "name" => "Podologia",
                "type" => "Salut",
                "manager_name" => "Dr. Marc Ferran",
                "manager_email" => "marc.ferran@example.com",
                "manager_phone" => "+34601555666",
                "schedules" => "Dimecres 9:00-14:00",
                "is_active" => true,
                "created_at" => now()->subDays(6),
                "updated_at" => now()->subDays(5),
            ],
            [
                "id" => 9,
                "center_id" => 9,
                "name" => "Atenció Mèdica 24h",
                "type" => "Salut",
                "manager_name" => "Equip Mèdic",
                "manager_email" => "medical.team@example.com",
                "manager_phone" => "+34601777888",
                "schedules" => "24h/7 dies",
                "is_active" => true,
                "created_at" => now()->subDays(4),
                "updated_at" => now()->subDays(3),
            ],
            [
                "id" => 10,
                "center_id" => 10,
                "name" => "Oci i Temps Lliure",
                "type" => "Social",
                "manager_name" => "Elena Vila",
                "manager_email" => "elena.vila@example.com",
                "manager_phone" => "+34601999000",
                "schedules" => "Caps de setmana",
                "is_active" => true,
                "created_at" => now()->subDays(2),
                "updated_at" => now()->subDays(1),
            ],
        ]);
    }
}
