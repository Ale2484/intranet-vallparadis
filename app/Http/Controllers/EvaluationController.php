<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Evaluation;

use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index(User $user)
    {
        $evaluation=Evaluation::where('user', $user->id)->get();
        $total=$evaluation->count();

        return view("evaluation.index", compact(
            'evaluation', 
            'user',
            "total"
        ));
    }

    public function store(Request $request, User $user)
    {        
        $validated = $request->validate([
            'comment' => 'required|string|max:255',
            'p1' => 'required|in:0,1,2,3',
            'p2' => 'required|in:0,1,2,3',
            'p3' => 'required|in:0,1,2,3',
            'p4' => 'required|in:0,1,2,3',
            'p5' => 'required|in:0,1,2,3',
            'p6' => 'required|in:0,1,2,3',
            'p7' => 'required|in:0,1,2,3',
            'p8' => 'required|in:0,1,2,3',
            'p9' => 'required|in:0,1,2,3',
            'p10' => 'required|in:0,1,2,3',
            'p11' => 'required|in:0,1,2,3',
            'p12' => 'required|in:0,1,2,3',
            'p13' => 'required|in:0,1,2,3',
            'p14' => 'required|in:0,1,2,3',
            'p15' => 'required|in:0,1,2,3',
            'p16' => 'required|in:0,1,2,3',
            'p17' => 'required|in:0,1,2,3',
            'p18' => 'required|in:0,1,2,3',
            'p19' => 'required|in:0,1,2,3',
            'p20' => 'required|in:0,1,2,3',
        ]);

        Evaluation::create(
            [
                'evaluator' => auth()->user()->id,
                'user' => $user->id,
            ] + $validated
        );

        return redirect()->route('evaluation.index', $user->id)->with('success', 'Evaluacio creada correctament.');
    }
}
