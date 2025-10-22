<?php

namespace App\Http\Controllers;

use App\Models\UniformityRenovation;
use Illuminate\Http\Request;
use App\Exports\UniformityRenovationExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class UniformityRenovationController extends Controller
{
    public function exportAllUniformityRenovation()
    {
        $renovations = UniformityRenovation::with(["uniformity.userAssigned","deliveredBy"])->get();

        Log::error("Aqui: ".$renovations);
        return Excel::download(new UniformityRenovationExport($renovations), 'renovaciones.xlsx');
    }

    public function exportUniformityRenovation($userId)
    {
        $renovations = UniformityRenovation::with(["uniformity.userAssigned", "deliveredBy"])->whereHas("uniformity", function ($query) use ($userId) {$query->where("user", $userId);})->get();

        return Excel::download(new UniformityRenovationExport($renovations), "renovaciones_usuario.xlsx");
    }

}
