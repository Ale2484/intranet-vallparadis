<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UniformityExport implements FromCollection, WithHeadings, WithStyles
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

    // Estilos
    public function styles(Worksheet $sheet)
    {
        return [
            // Aplica estilo a la primera fila (fila 1)
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFF6E3']], // Letras blancas
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF7E13'], // color fondo
                ],
            ],
        ];
    }
}