<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\ExternalContact;

class ExternalContactsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $contacts;

    public function __construct(Collection $contacts)
    {
        $this->contacts = $contacts;
    }

    public function collection()
    {
        return $this->contacts;
    }

    public function headings(): array
    {
        return [
            "Centro",
            "Categoría",
            "Motivo",
            "Empresa/Departamento",
            "Persona de contacto",
            "Teléfono",
            "Email",
            "Activo",
            "Observaciones",
        ];
    }

    public function map($row): array
    {
        return [
            optional($row->center)->name, // si quieres el nombre del centro
            $row->category,
            $row->reason,
            $row->company_or_department,
            $row->contact_person,
            $row->phone,
            $row->email,
            $row->is_active ? "Sí" : "No",
            $row->observations ?? "-",
        ];
    }
}
