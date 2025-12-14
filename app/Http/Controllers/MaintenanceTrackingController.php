<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\MaintenanceTracking;
use Illuminate\Http\Request;

class MaintenanceTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Maintenance $maintenance)
    {
        $comments=MaintenanceTracking::where('maintenance', $maintenance->id)->get()->sortByDesc('created_at');
        $total=$comments->count();

        return view("maintenance.tracking", compact(
            "maintenance",
            "comments",
            "total"
        ));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Maintenance $maintenance)
    {
        $validated = $request->validate([
            'comment' => 'required|string'
        ]);

        
        MaintenanceTracking::create([
            'user' => auth()->user()->id,
            'maintenance' => $maintenance->id,
            'description'=> $validated['comment']
        ]);
        
        return redirect()->route('maintenance.tracking', $maintenance->id)->with('success', 'Comentari creat correctament.');
    }
}