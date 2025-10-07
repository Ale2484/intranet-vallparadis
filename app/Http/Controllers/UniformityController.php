<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Uniformity;
use App\Models\User;
use App\Exports\UniformityExport;
use Maatwebsite\Excel\Facades\Excel;


class UniformityController extends Controller
{
    public function exportAllUniformity()
    {
        $uniformities = Uniformity::select("user","shirt","pants","shoes")->get();

        foreach ($uniformities as $key => $value) {
            $user = User::select("name")->where('id', $uniformities[$key] -> user)->get();

            $uniformities[$key]->user = $user[0]-> name;
        }

        return Excel::download(new UniformityExport($uniformities), 'uniformidades.xlsx');
        
    }

    public function exportUniformity(Request $request)
    {
        $uniformities = Uniformity::select("user","shirt","pants","shoes")->where('user', request("id"))->get();
        
        $user = User::select("name")->where('id', $uniformities[0] -> user)->get();

        $uniformities[0] -> user = $user[0]-> name;

        if (!($uniformities == "[]")){
            return Excel::download(new UniformityExport($uniformities), 'uniformidad.xlsx');
        } else {
            Log::error('no se ha encontrado el uniforme');
        }

    }
}
