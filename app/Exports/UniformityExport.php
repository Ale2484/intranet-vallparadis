<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UniformityExport implements FromCollection, WithHeadings
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
}