<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceComment;
use App\Models\Maintenance;
use App\Models\MaintenanceTracking;
use Illuminate\Http\Request;

class MaintenanceCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Maintenance $maintenance, MaintenanceTracking $tracking)
    {
        $validated = $request->validate([
            'comment' => 'required|string'
        ]);

        
        MaintenanceComment::create([
            'user' => auth()->user()->id,
            'maintenance' => $tracking->id,
            'description'=> $validated['comment']
        ]);
        
        return redirect()->route('maintenance.tracking.show', [$maintenance->id, $tracking->id])->with('success', 'Comentari creat correctament.');
    }
}
