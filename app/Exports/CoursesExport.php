<?php

namespace App\Exports;

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class CoursesExport implements FromCollection, ShouldAutoSize, WithStyles
{
    private $courses;
    private $coursesWithUsers;

    public function __construct()
    {
        // Se obtienen los cursos y sus usuarios
        $this->courses = Course::with("center")->get();
        $this->coursesWithUsers = Course::with("users")->has("users")->get();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = new Collection();

        // Header cursos
        $data->push([ "CENTRE", "CODI FORCEM", "HORES", "TIPUS", "PRESENCIAL / ONLINE / MIXT", "NOM FORMACIÓ / TALLER / JORNADA / CONGRÉS", "ASSISTENT", "DATA INICI", "DATA FINALITZACIÓ"]);

        foreach ($this->courses as $course) {
            $data->push([
                $course->center->name ?? "",
                $course->code,
                $course->hours,
                $course->type,
                $course->modality ? ucfirst($course->modality) : "No establert",
                $course->name,
                $course->assistantRelation ? $course->assistantRelation->name : "No assignat",
                $course->start_date ? Carbon::parse($course->start_date)->format("d/m/Y") : "No establert",
                $course->end_date ? Carbon::parse($course->end_date)->format("d/m/Y") : "No establert",
            ]);
        }

        // Espacios en blanco
        $data->push([""]);
        $data->push([""]);

        // Apartado de usuarios 
        $data->push(["NOM FORMACIÓ", "NOM USUARI", "EMAIL USUARI", "CERTIFICAT"]);

        foreach ($this->coursesWithUsers as $course) {
            foreach ($course->users as $user) {
                $data->push([
                    $course->name,
                    $user->name,
                    $user->email,
                    $user->pivot->certificate
                ]);
            }
        }
        return $data;
    }

    public function styles(Worksheet $sheet)
    {
        // Estilo general
        $sheet->getStyle("A:Z")->getAlignment()->setWrapText(true);

        $section1HeaderRow = 1;
        $section1EndRow = $section1HeaderRow + $this->courses->count();
        $section2HeaderRow = $section1EndRow + 3;
        $lastRow = $sheet->getHighestRow();

        // Header
        // Se establece el alto de la primera fila
        $sheet->getRowDimension($section1HeaderRow)->setRowHeight(22);
        // Se establece el estilo del header
        $sheet->getStyle("A{$section1HeaderRow}:I{$section1HeaderRow}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("948A54");
        // Se establece el color de texto del header y se pone en negrita
        $sheet->getStyle("A{$section1HeaderRow}:I{$section1HeaderRow}")->getFont()->setColor(new Color("F2F2F2"))->setBold(true);
        // Se establce el borde del header
        $sheet->getStyle("A{$section1HeaderRow}:I{$section1HeaderRow}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM)->getColor()->setARGB("000000");
        // Se alinea verticalmente y hortizontalmente el texto del header
        $sheet->getStyle("A{$section1HeaderRow}:I{$section1HeaderRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        // Se alinea horizontalmente el contenido de la tabla de cursos 
        $sheet->getStyle("B2:I" . $sheet->getHighestRow())->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        if ($this->courses->count() > 0) {
            $contentRange = "A" . ($section1HeaderRow + 1) . ":I{$section1EndRow}";
            $sheet->getStyle($contentRange)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("FDEADA");
            $sheet->getStyle($contentRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB("C5BD96");
            $contentStyle = $sheet->getStyle($contentRange)->getBorders();
            // Bordes verticales en el apartado de cursos
            $contentStyle->getVertical()->setBorderStyle(Border::BORDER_THIN);
            $contentStyle->getVertical()->getColor()->setARGB("000000");
    
            // Borde de la ultima fila de cursos
            $sheet->getStyle("A{$section1HeaderRow}:I{$section1EndRow}")->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB("000000");
            // Borde de la columna I
            $sheet->getStyle("I" . $section1HeaderRow + 1 . ":I{$section1EndRow}")->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB("000000");
        }

        // Estilo usuarios
        // Header
        $sheet->getStyle("A{$section2HeaderRow}:D{$section2HeaderRow}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("948A54");
        $sheet->getRowDimension($section2HeaderRow)->setRowHeight(22);
        $sheet->getStyle("A{$section2HeaderRow}:D{$section2HeaderRow}")->getFont()->setColor(new Color("F2F2F2"))->setBold(true);
        $sheet->getStyle("A{$section2HeaderRow}:D{$section2HeaderRow}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_MEDIUM)->getColor()->setARGB("000000");
        $sheet->getStyle("A{$section2HeaderRow}:D{$section2HeaderRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        if (!$this->coursesWithUsers->isEmpty()) {
            // Contenido
            if ($lastRow > $section2HeaderRow) {
                $contentRange_2 = "A" . ($section2HeaderRow + 1) . ":D{$lastRow}";
                $sheet->getStyle($contentRange_2)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("FDEADA");
                $sheet->getStyle($contentRange_2)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB("C5BD96");
            }
            $contentRange = "A" . ($section2HeaderRow + 1) . ":D{$lastRow}";
            $contentStyle = $sheet->getStyle($contentRange)->getBorders();
            $contentStyle->getVertical()->setBorderStyle(Border::BORDER_THIN);
            $contentStyle->getVertical()->getColor()->setARGB("000000");

            // Borde de la ultima fila de cursos
            $sheet->getStyle("A{$section2HeaderRow}:D{$lastRow}")->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB("000000");
            // Borde de la columna I
            $sheet->getStyle("D" . $section2HeaderRow + 1 . ":D{$lastRow}")->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB("000000");
        }
    }
}
