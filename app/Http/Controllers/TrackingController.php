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
        $trackings=Tracking::where('user', $user->id)->get();
        $total=$trackings->count();

        return view("trackings.index", compact(
            'trackings', 
            'user',
            "total"
        ));
    }

    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'topic' => 'required|string|max:255',
            'open' => 'required|boolean'
        ]);

        
        Tracking::create([
            'register' => auth()->user()->id,
            'user' => $user->id,
            'topic' => $validated['topic'],
            'open' => $validated['open']
        ]);
        
        return redirect()->route('trackings.index', $user->id)->with('success', 'Seguiment creat correctament.');
    }

    public function show(User $user, Tracking $tracking)
    {
        $comments=CommentsTracking::where('tracking', $tracking->id)->get();
        $total=$comments->count();

        return view("trackings.show", compact(
            "user",
            "tracking",
            "comments",
            "total"
        ));
    }
}
