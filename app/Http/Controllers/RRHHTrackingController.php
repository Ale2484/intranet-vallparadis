<?php

namespace App\Http\Controllers;

use App\Models\RRHHTracking;
use App\Models\RRHHTopic;
use Illuminate\Http\Request;

class RRHHTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RRHHTopic $rrhh)
    {
        $comments=RRHHTracking::where('issue', $rrhh->id)->get()->sortByDesc('created_at');
        $total=$comments->count();

        return view("rrhh.tracking", compact(
            "rrhh",
            "comments",
            "total"
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, RRHHTopic $rrhh)
    {
        $validated = $request->validate([
            'comment' => 'required|string'
        ]);

        
        RRHHTracking::create([
            'user' => auth()->user()->id,
            'issue' => $rrhh->id,
            'description'=> $validated['comment']
        ]);
        
        return redirect()->route('rrhh.tracking', $rrhh->id)->with('success', 'Comentari creat correctament.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RRHHTracking $rRHHTracking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RRHHTracking $rRHHTracking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RRHHTracking $rRHHTracking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RRHHTracking $rRHHTracking)
    {
        //
    }
}
