<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithMapping;


class UniformityExport implements FromCollection, WithHeadings, WithMapping
{
    protected $uniformity;

    public function __construct(Collection $uniformity)
    {
        $this->uniformity = $uniformity;
    }

    public function collection()
    {
        return $this->uniformity;
    }

    public function headings(): array
    {
        return [
            'Profesional',
            'Talla camiseta',
            'Talla pantalon',
            'Talla zapatos',
        ];
    }
    public function map($row): array
    {
        return [
            optional($row->userAssigned)->name,
            $row->shirt,
            $row->pants,
            $row->shoes,
        ];
    }
}