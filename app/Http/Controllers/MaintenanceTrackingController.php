<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\MaintenanceComment;
use App\Models\MaintenanceTracking;
use Illuminate\Http\Request;

class MaintenanceTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Maintenance $maintenance)
    {
        $trackings=MaintenanceTracking::where('maintenance', $maintenance->id)->get()->sortByDesc('created_at');
        $total=$trackings->count();

        return view("maintenance.tracking", compact(
            'trackings', 
            'maintenance',
            "total"
        ));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Maintenance $maintenance)
    {
        $validated = $request->validate([
            'topic' => 'required|string|max:255'
        ]);

        
        MaintenanceTracking::create([
            'maintenance' => $maintenance->id,
            'user' => auth()->user()->id,
            'topic' => $validated['topic'],
        ]);
        
        return redirect()->route('maintenance.tracking', $maintenance->id)->with('success', 'Seguiment creat correctament.');
    }
    public function show(Maintenance $maintenance, MaintenanceTracking $tracking)
    {
        $comments=MaintenanceComment::where('maintenance', $tracking->id)->get()->sortByDesc('created_at');
        $total=$comments->count();

        return view("maintenance.comment", compact(
            "maintenance",
            "tracking",
            "comments",
            "total"
        ));
    }
}