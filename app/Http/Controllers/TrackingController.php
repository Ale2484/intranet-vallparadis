<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\Tracking;
use App\Models\CommentsTracking;

use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index(User $user)
    {
        $trackingsOpenQuery = Tracking::where("user", $user->id)->whereNull("end_link");
        $trackingsClosedQuery = Tracking::where("user", $user->id)->whereNotNull("end_link");

        if (auth()->user()->role !== "equip_directiu") {
            $trackingsOpenQuery->where("open", 1);
            $trackingsClosedQuery->where("open", 1);
        }

        $trackingsOpen = $trackingsOpenQuery->get()->sortByDesc("created_at");
        $trackingsClosed = $trackingsClosedQuery->get()->sortByDesc("created_at");
        $trackings = $trackingsOpen->merge($trackingsClosed);
        $total=$trackings->count();

        return view("trackings.index", compact(
            "trackings",
            "user",
            "total"
        ));
    }

    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            "topic" => "required|string|max:255",
            "open" => "required|boolean"
        ]);

        if ($validated["open"] == 0 && auth()->user()->role !== "equip_directiu") {
            abort(403, "No tens permisos per crear seguiments restringits.");
        }
        
        Tracking::create([
            "register" => auth()->user()->id,
            "user" => $user->id,
            "topic" => $validated["topic"],
            "open" => $validated["open"]
        ]);
        
        return redirect()->route("trackings.index", $user->id)->with("success", "Seguiment creat correctament.");
    }

    public function show(User $user, Tracking $tracking)
    {
        if (!$tracking->open && auth()->user()->role !== "equip_directiu") {
            abort(403, "No tens permisos per accedir a aquest seguiment.");
        }

        $comments=CommentsTracking::where("tracking", $tracking->id)->get()->sortByDesc("created_at");
        $total=$comments->count();

        return view("trackings.show", compact(
            "user",
            "tracking",
            "comments",
            "total"
        ));
    }

    public function deactivate(User $user, Tracking $tracking)
    {
        $tracking->update(["end_link" => now()]);
        return redirect()->route("trackings.show", ['user' => $user->id, 'tracking' => $tracking->id])->with("success", "Seguiment finalitzat correctament");
    }
}
