<?php

namespace App\Http\Controllers;

use App\Models\AccidentabiliteComment;
use App\Models\User;
use App\Models\Accidentabilite;
use Illuminate\Http\Request;

class AccidentabiliteController extends Controller
{
    public function index(User $user)
    {
        $trackings=Accidentabilite::where('user', $user->id)->get()->sortByDesc('created_at');
        $total=$trackings->count();

        return view("accidentabilites.index", compact(
            'trackings', 
            'user',
            "total"
        ));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'start'       => 'nullable|date|required_with:end',
            'end'         => 'nullable|date|after_or_equal:start',
            'context'     => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        
        Accidentabilite::create([
            'user'     => $user->id,
            'evaluate' => auth()->user()->id,
        ] + $validated);
        
        return redirect()->route('accidentabilites.index', $user->id)->with('success', 'Accidentabilitat creada correctament.');
    }

    public function show(User $user, Accidentabilite $tracking)
    {
        $comments=AccidentabiliteComment::where('accidentabilitie', $tracking->id)->get()->sortByDesc('created_at');
        $total=$comments->count();

        return view("accidentabilites.show", compact(
            "user",
            "tracking",
            "comments",
            "total"
        ));
    }
}
