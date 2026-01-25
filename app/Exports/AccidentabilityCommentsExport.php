<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AccidentabilityCommentsExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $accidentability;
    protected $comments;

    public function __construct($accidentability, Collection $comments)
    {
        $this->accidentability = $accidentability;
        $this->comments = $comments;
    }

    public function collection()
    {
        // Solo retornamos los comentarios
        return $this->comments;
    }

    public function headings(): array
    {
        // Encabezados para la tabla de comentarios
        // Estos se colocarán automáticamente en la fila 9
        return [
            "Data",
            "Usuari",
            "Comentari"
        ];
    }

    public function map($comment): array
    {
        // Solo mapeamos comentarios
        return [
            $comment->created_at ? $comment->created_at->format('d/m/Y') : '',
            optional($comment->userRelation)->name ?? '',
            $comment->description ?? ''
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $worksheet = $event->sheet->getDelegate();
                
                // Obtener información de la accidentabilidad
                $accidentability = $this->accidentability;
                $startDate = $accidentability->start ? \Carbon\Carbon::parse($accidentability->start)->format('d/m/Y') : '';
                $endDate = $accidentability->end ? \Carbon\Carbon::parse($accidentability->end)->format('d/m/Y') : '';
                $period = $startDate && $endDate ? "{$startDate} - {$endDate}" : '';
                
                // Insertar 8 filas al inicio para la información de accidentabilidad
                // y dejar espacio para los encabezados en la fila 9
                $event->sheet->insertNewRowBefore(1, 8);
                
                // Escribir la información de accidentabilidad
                $event->sheet->setCellValue('A1', 'Accidentabilitat');

                $event->sheet->setCellValue('A2', 'Usuari: ');
                $event->sheet->setCellValue('B2', optional($accidentability->userRelation)->name);

                $event->sheet->setCellValue('A3', 'Avaluador: ');
                $event->sheet->setCellValue('B3', optional($accidentability->evaluateRelation)->name);

                $event->sheet->setCellValue('A4', 'Període: ');
                $event->sheet->setCellValue('B4', $period);

                $event->sheet->setCellValue('A5', 'Context: ');
                $event->sheet->setCellValue('B5', $accidentability->context ?? '');

                $event->sheet->setCellValue('A6', 'Descripcio: ');
                $event->sheet->setCellValue('B6', $accidentability->description ?? '');
                
                // Línea separadora en la fila 8
                $event->sheet->setCellValue('A8', str_repeat('-', 50));
                
                // Ahora los encabezados automáticos estarán en la fila 9
                // y los datos empezarán en la fila 10
                
                // Ajustar el ancho de las columnas
                $event->sheet->getColumnDimension('A')->setWidth(15);
                $event->sheet->getColumnDimension('B')->setWidth(25);
                $event->sheet->getColumnDimension('C')->setWidth(40);
                
                // Estilos para la información de accidentabilidad
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14]
                ]);
                
                // Negrita para las etiquetas
                $event->sheet->getStyle('A2:A6')->applyFromArray([
                    'font' => ['bold' => true]
                ]);
                
                // Fusionar celdas para el título principal
                $event->sheet->mergeCells('A1:C1');
                
                // Fusionar celdas para descripción larga
                $event->sheet->mergeCells('B6:C6');
                
                // Establecer wrap text para descripción
                $event->sheet->getStyle('B6')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('B6')->getAlignment()->setVertical('top');
                
                // Ajustar altura de fila para descripción
                $event->sheet->getRowDimension(6)->setRowHeight(-1);
                
                // Fusionar celdas de la línea separadora (fila 8)
                $event->sheet->mergeCells('A8:C8');
                
                // Añadir borde inferior a la línea separadora
                $event->sheet->getStyle('A8')->applyFromArray([
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                        ]
                    ]
                ]);
                
                // Estilos para los encabezados de la tabla (fila 9)
                $event->sheet->getStyle('A9:C9')->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FFE0E0E0']
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                        ]
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ]
                ]);
                
                // Ajustar el wrap text para la columna de comentarios
                $event->sheet->getStyle('C')->getAlignment()->setWrapText(true);
                $event->sheet->getStyle('C')->getAlignment()->setVertical('top');
                
                // Añadir bordes a toda la tabla de comentarios (incluyendo encabezados)
                $lastRow = 9 + $this->comments->count(); // Fila 9 + cantidad de comentarios
                if ($this->comments->count() > 0) {
                    $event->sheet->getStyle('A9:C' . $lastRow)->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                            ]
                        ]
                    ]);
                    
                    // Ajustar altura de filas para comentarios largos
                    for ($i = 10; $i <= $lastRow; $i++) {
                        $event->sheet->getRowDimension($i)->setRowHeight(-1);
                    }
                }
                
                // Ajustar alineación para la columna de fecha
                $event->sheet->getStyle('A10:A' . $lastRow)->getAlignment()->setHorizontal('center');
                
                // Ajustar alineación para la columna de usuario
                $event->sheet->getStyle('B10:B' . $lastRow)->getAlignment()->setHorizontal('center');
            }
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Estilo para el título
            1 => [
                'font' => [
                    'bold' => true, 
                    'size' => 14
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ]
            ],
        ];
    }
}