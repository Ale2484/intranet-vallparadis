<?php

namespace App\Http\Controllers;

use App\Models\AccidentabiliteComment;
use App\Models\User;
use App\Models\Accidentabilite;
use Illuminate\Http\Request;

class AccidentabiliteCommentController extends Controller
{
    public function store(Request $request, User $user, Accidentabilite $tracking)
    {
        $validated = $request->validate([
            'comment' => 'required|string'
        ]);

        
        AccidentabiliteComment::create([
            'user' => auth()->user()->id,
            'accidentabilitie' => $tracking->id,
            'description'=> $validated['comment']
        ]);
        
        return redirect()->route('accidentabilites.show', [$user->id, $tracking->id])->with('success', 'Comentari creat correctament.');
    }
}
