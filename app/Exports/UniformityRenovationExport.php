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
            "Fecha de renovación",
            "Entregado por",
            "Entregado a",
            "Talla Camiseta",
            "Talla Pantalón",
            "Talla Zapatos",
        ];
    }
    public function map($row): array
    {
        return [
            $row->renewal_date,
            optional($row->deliveredBy)->name,
            optional($row->uniformity?->userAssigned)->name,
            optional($row->uniformity)->shirt,
            optional($row->uniformity)->pants,
            optional($row->uniformity)->shoes,
        ];
    }
}
