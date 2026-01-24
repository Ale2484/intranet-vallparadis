<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;

class EvaluationExport implements FromArray
{
    protected $evaluations;

    public function __construct(Collection $evaluations)
    {
        $this->evaluations = $evaluations;
    }

    public function array(): array
    {
        $labels = [
            0 => "Gens d’acord",
            1 => "Poc d’acord",
            2 => "Bastant d’acord",
            3 => "Molt d’acord",
        ];

        // Lista de preguntas con su clave (p1, p2...)
        $questions = [
            "p1"  => "Realitza una correcta atenció a l'usuari",
            "p2"  => "Es preocupa per satisfer les seves necessitats dins dels recursos dels que disposa",
            "p3"  => "S'ha integrat dins l'equip de treball i participa i coopera sense dificultats",
            "p4"  => "Pot treballar amb altres equips diferents al seu si es necessita",
            "p5"  => "Compleix amb les funcions establertes",
            "p6"  => "Assoleix els objectius utilitzant els recursos disponibles per aconseguir els resultats esperats",
            "p7"  => "És coherent amb el que diu i amb les seves actuacions",
            "p8"  => "Les seves actuacions van alineades amb els valors de la nostra Entitat",
            "p9"  => "Mostra capacitat i interès en entendre i aplicar la normativa i els procediments establerts",
            "p10" => "La seva actitud envers els seus responsables/comandaments és correcta",
            "p11" => "Té capacitat per a comprendre i acceptar i adequar-se als canvis",
            "p12" => "Desenvolupa amb autonomia les seves funcions, sense necessitat de recolzament immediat/constant",
            "p13" => "Fa suggeriments i propostes de millora",
            "p14" => "Assoleix els objectius, esforçant-se per aconseguir el resultat esperat",
            "p15" => "La quantitat de treball que desenvolupa en relació amb el treball encomanat és adequada",
            "p16" => "Realitza les tasques amb la qualitat esperada i/o necessària",
            "p17" => "Expressa amb claredat i ordre els aspectes rellevants de la informació",
            "p18" => "Disposa del coneixements necessaris per a desenvolupar les tasques requerides del lloc de treball",
            "p19" => "Mostra interès i motivació envers el seu lloc de treball",
            "p20" => "La seva entrada i permanència en el lloc de treball es duu a terme sense retards o absències no justificades",
        ];

        // 1) Fila del header (nombres de evaluaciones)
        $rows[] = array_merge(
            ['Pregunta / Evaluació'],
            $this->evaluations->map(fn($e) => optional($e->userRelation)->name)->toArray()
        );

        // 2) Fila del evaluador
        $rows[] = array_merge(
            ['Avaluador'],
            $this->evaluations->map(fn($e) => optional($e->evaluatorRelation)->name)->toArray()
        );

        // 3) Filas de preguntas (p1..p20) automatizadas
        foreach ($questions as $key => $question) {
            $rows[] = array_merge(
                [$question],
                $this->evaluations->map(fn($e) => $labels[$e->$key] ?? $e->$key)->toArray()
            );
        }

        // 4) Fila de comentarios
        $rows[] = array_merge(
            ['Comentari'],
            $this->evaluations->map(fn($e) => $e->comment)->toArray()
        );

        return $rows;
    }
}
