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

    public function edit(User $user)
    {
        $sizes = ["S", "M", "L", "XL", "XXL", "3XL", "36", "38", "40", "42", "44", "46", "48", "50", "52", "54", "56", "58"];
        $userEdit = $user;
        $users = User::all();
        $uniformity = $user->uniformity;

        return view("uniformity.edit", compact("uniformity", "users", "sizes", "userEdit"));
    }
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            "pants" => "required",
            "shirt" => "required",
            "shoes" => "required",
            "userRenewal" => "required"

        ]);

        $user->uniformity->update($validated);

        return redirect()->route("users.index")->with("success", "Uniforme renovat correctament");
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
