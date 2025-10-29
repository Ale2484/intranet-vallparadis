<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Tracking;

use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index(User $user)
    {
        $trackings=Tracking::where('user', $user->id)->get();
        $total=$trackings->count();

        return view("trackings.index", compact(
            'trackings', 
            'user',
            "total"
        ));
    }
}
