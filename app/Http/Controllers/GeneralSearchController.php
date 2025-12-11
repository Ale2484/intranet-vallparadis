<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GeneralSearchController extends Controller
{
    public function generalSearch(Request $request)
    {
        $request->validate([
            "search" => "required"
        ]);
        $htmlContent = [];
        $searchUsers = User::where("name", "like" , "%$$request->search%")->paginate(1, ["*"], "page", 2);
        if (!empty($searchUsers)) {
            foreach ($searchUsers as $user) {
                $htmlContent .= view("components.user-card", compact("user"))->render();
            }
            // Se obtiene la paginacion
            $pagination = $searchUsers->links()->render();
        }
        return response()->json(["htmlContent" => $htmlContent, "pagination" => $pagination]);

    }
}
