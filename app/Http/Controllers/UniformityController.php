<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Uniformity;
use App\Models\User;
use App\Exports\UniformityExport;
use App\Models\UniformityRenovation;
use Maatwebsite\Excel\Facades\Excel;


class UniformityController extends Controller
{

    public function edit(User $user)
    {
        $sizes = ["S", "M", "L", "XL", "XXL", "3XL", "36", "38", "40", "42", "44", "46", "48", "50", "52", "54", "56", "58"];
        $userEdit = $user;
        $users = User::all();
        $uniformity = $user->uniformity;
        if (!$uniformity) {
            // Se crea un objeto vacio para evitar el null
            $uniformity = new \stdClass();
            $uniformity->pants = "";
            $uniformity->shirt = "";
            $uniformity->shoes = "";
        }
        return view("uniformity.edit", compact("uniformity", "users", "sizes", "userEdit"));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            "pants" => "nullable",
            "shirt" => "nullable",
            "shoes" => "nullable|numeric|min:30|max:50",
            "userRenewal" => "required|exists:users,id"

        ]);
        // Si minimo se renuva una cosa
        if ($validated["pants"] || $validated["shirt"] || $validated["shoes"]) {
            // Se obtiene el uniforme del usuario
            $uniformity = $user->uniformity;
            // Si no existe ningun registro se crea uno
            if (!$uniformity) {
                $uniformity = Uniformity::create([
                    "user" => $user->id,
                    "pants" => $validated["pants"],
                    "shirt" => $validated["shirt"],
                    "shoes" => $validated["shoes"]
                ]);
    
                // Se crea un nuevo registro de las renovaciones
                UniformityRenovation::create([
                    "uniformity_id" => $uniformity->id,
                    "renewal_date" => now(),
                    "delivered_by" => $validated["userRenewal"],
                    "pants_renewal" => $validated["pants"],
                    "shirt_renewal" => $validated["shirt"],
                    "shoes_renewal" => $validated["shoes"],
                    "file" => "",
                ]);
            } else{
                $renovation = [
                    "uniformity_id" => $uniformity->id,
                    "renewal_date" => now(),
                    "delivered_by" => $validated["userRenewal"],
                    "file" => "",
                ];
                $hasChange = false;
                // Si tenia ya un uniforme, se compara si cambia algo para crear la renovacion
                if ($validated["pants"] != $uniformity->pants) {
                    $renovation["pants_renewal"] = $validated["pants"];
                    $hasChange = true;
                }
                if ($validated["shirt"] != $uniformity->shirt) {
                    $renovation["shirt_renewal"] = $validated["shirt"];
                    $hasChange = true;
                }
                if ($validated["shoes"] != $uniformity->shoes) {
                    $renovation["shoes_renewal"] = $validated["shoes"];
                    $hasChange = true;
                }
    
                // Si se ha renovado algo, se crea un nuevo registro en la tabla de renovaciones, y se actualiza el uniforme actual
                if ($hasChange) {
                    $user->uniformity->update([
                        "pants" => $validated["pants"],
                        "shirt" => $validated["shirt"],
                        "shoes" => $validated["shoes"]
                    ]);
                    }
                UniformityRenovation::create($renovation);
    
            }
            return redirect()->route("users.show", $user)->with("success", "Uniforme renovat correctament");
        } else{
            return back()->with("error", "Has de seleccionar almenys un element per renovar");
        }

    }

    public function exportAllUniformity()
    {
        $uniformities = Uniformity::with(["userAssigned"])->get();

        return Excel::download(new UniformityExport($uniformities), 'uniformidades.xlsx');
    }

    public function exportUniformity($userId)
    {
        $uniformities = Uniformity::with(["userAssigned"])->where('user', $userId)->get();

        return Excel::download(new UniformityExport($uniformities), 'uniformidad.xlsx');
    }
}
