<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\Tracking;
use App\Models\CommentsTracking;

use Illuminate\Http\Request;

class CommentsTrackingController extends Controller
{
    public function store(Request $request, User $user, Tracking $tracking)
    {
        if (!$tracking->open && auth()->user()->role !== "equip_directiu") {
            abort(403, "No tens permisos per comentar en aquest seguiment.");
        }

        $validated = $request->validate([
            "comment" => "required|string"
        ]);

        
        CommentsTracking::create([
            "user" => auth()->user()->id,
            "tracking" => $tracking->id,
            "comment"=> $validated["comment"]
        ]);
        
        return redirect()->route("trackings.show", [$user->id, $tracking->id])->with("success", "Comentari creat correctament.");
    }
}
