<?php

namespace App\Http\Controllers;

use App\Models\UniformityRenovation;
use Illuminate\Http\Request;
use App\Exports\UniformityRenovationExport;
use Maatwebsite\Excel\Facades\Excel;

class UniformityRenovationController extends Controller
{
    public function exportAllUniformityRenovation()
    {
        $renovations = UniformityRenovation::with(["uniformity.userAssigned","deliveredBy"])->get();

        return Excel::download(new UniformityRenovationExport($renovations), 'renovaciones.xlsx');
    }

    public function exportUniformityRenovation($userId)
    {
        $renovations = UniformityRenovation::with(["uniformity.userAssigned", "deliveredBy"])->whereHas("uniformity", function ($query) use ($userId) {$query->where("user", $userId);})->get();

        return Excel::download(new UniformityRenovationExport($renovations), "renovaciones_usuario.xlsx");
    }

}
