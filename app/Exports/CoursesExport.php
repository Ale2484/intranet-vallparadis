<?php

namespace App\Exports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;



class CoursesExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // Se obtienen todos los cursos con todos sus usuarios
    public function collection()
    {
        return Course::with("center", "assistantRelation")->get();
    }

    public function map($course) :array
    {
        return [
            $course->center->name ?? "",
            $course->code,
            $course->hours,
            $course->type,
            $course->modality,
            $course->name,
            $course->assistantRelation->name ?? "",
            $course->start_date,
            $course->end_date
        ];
    }
    // Primera linea
    public function headings() :array
    {
        return ["CENTRE", "CODI FORCEM", "HORES", "TIPUS", "PRESENCIAL / ONLINE", "NOM FORMACIÓ / TALLER / JORNADA / CONGRÉS", "ASSISTENT", "DATA INICI", "DATA FINALITZACIÓ"];
    }

    public function columnWidths(): array
    {
        return [
            "A" => 30,
            "B" => 25,
            "C" => 20,
            "D" => 30,
            "E" => 40,
            "F" => 60,
            "G" => 20,
            "H" => 20,
            "I" => 20
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Hacer que la primera fila tenga un alto determinado
        $sheet->getRowDimension(1)->setRowHeight(22);
        // Hacer que el texto salte de linea si es demasiado largo
        $sheet->getStyle("A:Z")->getAlignment()->setWrapText(true);
        // Hacer que el header tenga el color de fondo #948A54
        $sheet->getStyle("A1:I1")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("948A54");
        // Hacer que el texto del header sea de color blanco y este en negrita
        $sheet->getStyle("A1:I1")->getFont()->setColor(new Color("F2F2F2"))->setBold(true); 
        // Hacer que el header tenga bordes
        $sheet->getStyle("A1:I1")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM)->getColor()->setARGB("000000");
        // Hacer que se centre horizontal y verticalmente el texo del header
        $sheet->getStyle("A1:I1")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        // Hacer que se aplique el color de fondo al contenido
        $sheet->getStyle("A2:I" . $sheet->getHighestRow())->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("FDEADA");
        // Hacer que el contenido tenga bordes
        $sheet->getStyle("A2:I" . $sheet->getHighestRow())->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB("C5BD96");
        
        // Bordes verticales
        $contentStyle = $sheet->getStyle("A2:I" . $sheet->getHighestRow())->getBorders();
        $contentStyle->getVertical()->setBorderStyle(Border::BORDER_THIN);
        $contentStyle->getVertical()->getColor()->setARGB("000000");
        // Borde de la ultima fila
        $sheet->getStyle("A" . $sheet->getHighestRow() . ":I" . $sheet->getHighestRow())->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB("000000");
        // Borde a la columna I 
        $sheet->getStyle("I2:I" . $sheet->getHighestRow())->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB("000000");
        // Centrar contenido horizontalmente
        $sheet->getStyle("B2:I" . $sheet->getHighestRow())->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    }
}
