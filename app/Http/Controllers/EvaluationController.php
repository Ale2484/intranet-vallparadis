<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Evaluation;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Exports\EvaluationExport;
use Maatwebsite\Excel\Facades\Excel;

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

        $evaluations=Evaluation::where('user', $user->id)->orderBy('created_at', 'desc')->get();

        $questions = [
            "Realitza una correcta atenció a l'usuari",
            "Es preocupa per satisfer les seves necessitats dins dels recursos dels que disposa",
            "S'ha integrat dins l'equip de treball i participa i coopera sense dificultats",
            "Pot treballar amb altres equips diferents al seu si es necessita",
            "Compleix amb les funcions establertes",
            "Assoleix els objectius utilitzant els recursos disponibles  per aconseguir els resultats esperats",
            "És coherent amb el que diu i amb les seves actuacions",
            "Les seves actuacions van alineades amb els valors de la nostra Entitat",
            "Mostra capacitat i interès en entendre i aplicar la normativa i els procediments establerts ",
            "La seva actitud envers els seus responsables/comandaments és correcta",
            "Té capacitat per a comprendre i acceptar  i adequar-se als canvis",
            "Desenvolupa amb autonomia les seves funcions, sense necessitat de recolzament immediat/constant",
            "Fa suggeriments i propostes de millora",
            "Assoleix els objectius, esforçant-se per aconseguir el resultat esperat",
            "La quantitat de treball que desenvolupa en relació amb el treball encomanat és adequada",
            "Realitza les tasques amb la qualitat esperada i/o necessària",
            "Expressa amb claredat i ordre els aspectes rellevants de la informació",
            "Disposa del coneixements necessaris per a desenvolupar les tasques requerides del lloc de treball",
            "Mostra interès i motivació envers el seu lloc de treball",
            "La seva entrada i permanència en el lloc de treball es duu a terme sense retards o absències no justificades",
        ];

        $answers=[
            "0" => "Gens d'acord",
            "1" => "Poc d'acord",
            "2" => "Bastant d'acord",
            "3" => "Molt d'acord"
        ];

        return view("evaluation.index", compact(
            'evaluations', 
            'user',
            "total",
            "averageScore",
            "lastScore",
            "questionAverage",
            "questions",
            "answers"
        ));
    }

    public function store(Request $request, User $user)
    {      
        
        LOG::info($request);
        $validated = $request->validate([
            'comment' => 'nullable|string|max:255',
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
        
        return redirect()->route('evaluations.index', $user->id)->with('success', 'Avaluació creada correctament.');
    }

    public function create(User $user)
    {
        $questions = [
            "Realitza una correcta atenció a l'usuari",
            "Es preocupa per satisfer les seves necessitats dins dels recursos dels que disposa",
            "S'ha integrat dins l'equip de treball i participa i coopera sense dificultats",
            "Pot treballar amb altres equips diferents al seu si es necessita",
            "Compleix amb les funcions establertes",
            "Assoleix els objectius utilitzant els recursos disponibles  per aconseguir els resultats esperats",
            "És coherent amb el que diu i amb les seves actuacions",
            "Les seves actuacions van alineades amb els valors de la nostra Entitat",
            "Mostra capacitat i interès en entendre i aplicar la normativa i els procediments establerts ",
            "La seva actitud envers els seus responsables/comandaments és correcta",
            "Té capacitat per a comprendre i acceptar  i adequar-se als canvis",
            "Desenvolupa amb autonomia les seves funcions, sense necessitat de recolzament immediat/constant",
            "Fa suggeriments i propostes de millora",
            "Assoleix els objectius, esforçant-se per aconseguir el resultat esperat",
            "La quantitat de treball que desenvolupa en relació amb el treball encomanat és adequada",
            "Realitza les tasques amb la qualitat esperada i/o necessària",
            "Expressa amb claredat i ordre els aspectes rellevants de la informació",
            "Disposa del coneixements necessaris per a desenvolupar les tasques requerides del lloc de treball",
            "Mostra interès i motivació envers el seu lloc de treball",
            "La seva entrada i permanència en el lloc de treball es duu a terme sense retards o absències no justificades",
        ];
        
        $evaluation = new Evaluation();
        return view("evaluation.create", compact(
            "evaluation",
            "user",
            "questions"
        ));
    }

    public function export($id)
    {
        $eval = Evaluation::where("id", $id)->get();

        return Excel::download(new EvaluationExport($eval), 'evaluacion.xlsx');
    }
}