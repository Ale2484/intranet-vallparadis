<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Evaluation;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index(User $user)
    {
        $evaluations=Evaluation::where('user', $user->id)->get();
        $total=$evaluations->count();
        $averageScore = $total > 0 ? $evaluations->avg(fn($e) => $e->average_score) : 0;
        $last = $evaluations->sortByDesc('created_at')->first();
        $lastScore = $last ? $last->average_score : 0;

        // esto es para la media de cada pregunta (no he encontrado una forma mejor de hacerlo)
        $questionAverage = [];

        foreach ($evaluations as $evaluation) {
            for ($i = 1; $i <= 20; $i++) { 
                $key = "p".$i;
                if (isset($questionAverage[$key])) {
                    $questionAverage[$key] += $evaluation[$key];
                } else {
                    $questionAverage[$key] = $evaluation[$key];
                }
            }
        }
        
        if($total>0){
            for ($i=1; $i <= 20 ; $i++) { 
                $key = "p".$i;
                $questionAverage[$key]/=$total;
            }
        }

        $evaluations=Evaluation::where('user', $user->id)->orderBy('created_at', 'desc')->paginate(4);

        $questions = [
            "p1",
            "p2",
            "p3",
            "p4",
            "p5",
            "p6",
            "p7",
            "p8",
            "p9",
            "p10",
            "p11",
            "p12",
            "p13",
            "p14",
            "p15",
            "p16",
            "p17",
            "p18",
            "p19",
            "p20",
        ];

        return view("evaluation.index", compact(
            'evaluations', 
            'user',
            "total",
            "averageScore",
            "lastScore",
            "questionAverage",
            "questions"
        ));
    }

    public function store(Request $request, User $user)
    {      
        
        LOG::info($request);
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
        
        return redirect()->route('evaluations.index', $user->id)->with('success', 'Evaluacio creada correctament.');
    }

    public function create(User $user)
    {
        $questions = [
            "p1",
            "p2",
            "p3",
            "p4",
            "p5",
            "p6",
            "p7",
            "p8",
            "p9",
            "p10",
            "p11",
            "p12",
            "p13",
            "p14",
            "p15",
            "p16",
            "p17",
            "p18",
            "p19",
            "p20",
        ];
        $evaluation = new Evaluation();
        return view("evaluation.create", compact(
            "evaluation",
            "user",
            "questions"
        ));
    }
}
