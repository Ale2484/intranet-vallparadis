<?php

namespace App\Exports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CoursesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // Se obtienen todos los cursos con todos sus usuarios
    public function collection()
    {
        return Course::with("users")->get();
    }

    public function map($course) :array
    {
        // Se comienza la linea con el nombre del curso
        $row = [$course->name];
        // Por cada usuario, se añade su nombre a la derecha del curso
        foreach ($course->users as $user) {
            $row[] = $user->name;
        }
        // Se retorna la fila
        return $row;
    }
    // Primera linea
    public function headings() :array
    {
        return ["Nombre", "Usuaris"];
    }
}
