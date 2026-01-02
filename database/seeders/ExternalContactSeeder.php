<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExternalContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "center_id" => 1,
                "category" => "assistencial",
                "reason" => "Consulta mèdica",
                "company_or_department" => "Hospital Vallparadis",
                "contact_person" => "Dr. Joan Pérez",
                "phone" => "931234567",
                "email" => "joan.perez@hospital.com",
                "is_active" => true,
                "observations" => "Contacte per a derivacions urgents.",
                "created_at" => now()->subDays(20),
                "updated_at" => now()->subDays(19)
            ],
            [
                "center_id" => 2,
                "category" => "serveis generals",
                "reason" => "Manteniment ascensor",
                "company_or_department" => "Ascensors Ràpids S.L.",
                "contact_person" => "Sra. Laura Garcia",
                "phone" => "932345678",
                "email" => "laura.garcia@ascensorsrapids.com",
                "is_active" => true,
                "observations" => "Revisió mensual i reparacions.",
                "created_at" => now()->subDays(18),
                "updated_at" => now()->subDays(17)
            ],
            [
                "center_id" => 3,
                "category" => "assistencial",
                "reason" => "Suport psicològic",
                "company_or_department" => "Centre de Psicologia Integral",
                "contact_person" => "Psic. Marta Bosch",
                "phone" => "933456789",
                "email" => "marta.bosch@psicointegral.com",
                "is_active" => true,
                "observations" => "Suport per a pacients amb ansietat.",
                "created_at" => now()->subDays(14),
                "updated_at" => now()->subDays(13)
            ],
            [
                "center_id" => 4,
                "category" => "serveis generals",
                "reason" => "Neteja d'instal·lacions",
                "company_or_department" => "Neteja Brillant S.A.",
                "contact_person" => "Sr. Pere Roca",
                "phone" => "934567890",
                "email" => "pere.roca@neteja.com",
                "is_active" => true,
                "observations" => "Neteja diària d'oficines.",
                "created_at" => now()->subDays(12),
                "updated_at" => now()->subDays(11)
            ],
            [
                "center_id" => 5,
                "category" => "assistencial",
                "reason" => "Visita a domicili",
                "company_or_department" => "Infermeria a Casa",
                "contact_person" => "Inf. Carles Soler",
                "phone" => "935678901",
                "email" => "carles.soler@infermeriaacasa.com",
                "is_active" => true,
                "observations" => "Atenció a pacients amb mobilitat reduïda.",
                "created_at" => now()->subDays(10),
                "updated_at" => now()->subDays(9)
            ],
            [
                "center_id" => 6,
                "category" => "serveis generals",
                "reason" => "Seguretat privada",
                "company_or_department" => "Seguretat Total S.L.",
                "contact_person" => "Sr. Marc Vidal",
                "phone" => "936789012",
                "email" => "marc.vidal@seguretat.com",
                "is_active" => true,
                "observations" => "Vigilància 24h.",
                "created_at" => now()->subDays(8),
                "updated_at" => now()->subDays(7)
            ],
            [
                "center_id" => 7,
                "category" => "assistencial",
                "reason" => "Teràpia ocupacional",
                "company_or_department" => "Centre de Rehabilitació Funcional",
                "contact_person" => "Terapeuta Anna Pons",
                "phone" => "937890123",
                "email" => "anna.pons@rehabilitacio.com",
                "is_active" => true,
                "observations" => "Rehabilitació post-operatòria.",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "center_id" => 8,
                "category" => "serveis generals",
                "reason" => "Subministrament material d'oficina",
                "company_or_department" => "Material Oficina Express",
                "contact_person" => "Sra. Clara Fuster",
                "phone" => "938901234",
                "email" => "clara.fuster@materialoficina.com",
                "is_active" => true,
                "observations" => "Entrega setmanal de material.",
                "created_at" => now()->subDays(6),
                "updated_at" => now()->subDays(5)
            ],
            [
                "center_id" => 9,
                "category" => "assistencial",
                "reason" => "Nutrició i dietètica",
                "company_or_department" => "Consulta de Nutrició Saludable",
                "contact_person" => "Nutricionista Èric Rovira",
                "phone" => "939012345",
                "email" => "eric.rovira@nutricio.com",
                "is_active" => true,
                "observations" => "Dietes personalitzades.",
                "created_at" => now()->subDays(4),
                "updated_at" => now()->subDays(3)
            ],
            [
                "center_id" => 10,
                "category" => "serveis generals",
                "reason" => "Gestió de residus",
                "company_or_department" => "Residus Net S.A.",
                "contact_person" => "Sr. Jordi Noguera",
                "phone" => "930123456",
                "email" => "jordi.noguera@residusnet.com",
                "is_active" => false,
                "observations" => "Recollida de residus especials.",
                "created_at" => now()->subDays(2),
                "updated_at" => now()->subDays(1)
            ],
        ];

        DB::table("external_contacts")->insert($data);
    }
}