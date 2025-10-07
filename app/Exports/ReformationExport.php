<?php

namespace App\Exports;

use App\Models\Uniformity;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReformationExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Uniformity::all();
    }
}
