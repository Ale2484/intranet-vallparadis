<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class UniformityRenovationExport implements FromCollection, WithHeadings, WithMapping
{
    protected $uniformityRenovation;

    public function __construct(Collection $uniformityRenovation)
    {
        $this->uniformityRenovation = $uniformityRenovation;
    }

    public function collection()
    {
        return $this->uniformityRenovation;
    }
    // Añadir primera fila 
    public function headings(): array
    {
        return [
            "Data de renovació",
            "Entregat per",
            "Entregat a",
            "Mida Samarreta",
            "Mida Pantaló",
            "Mida Sabates",
        ];
    }
    public function map($row): array
    {
        return [
            $row->renewal_date,
            optional($row->deliveredBy)->name,
            optional($row->uniformity?->userAssigned)->name,
            $row->shirt_renewal ?? "-",
            $row->pants_renewal ?? "-",
            $row->shoes_renewal ?? "-",
        ];
    }
}
