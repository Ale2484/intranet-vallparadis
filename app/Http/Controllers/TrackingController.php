<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\Tracking;

use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index(User $user)
    {
        $trackings=Tracking::where('user', $user->id)->get();
        $total=$trackings->count();

        return view("trackings.index", compact(
            'trackings', 
            'user',
            "total"
        ));
    }

    public function store(Request $request)
    {
        return redirect()->route('users.index')->with('success', 'Professional creat correctament.');
        Log::error($test);
        Log::error("dalñdmañl");

        $validated = $request->validate([
            'topic' => 'required|string|max:255',
            'open' => 'required|boolean'
        ]);

        Tracking::create($validated);

    }
}
