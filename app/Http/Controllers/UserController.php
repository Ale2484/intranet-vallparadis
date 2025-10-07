<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function exportAllLockers()
    {
        $users = User::all()->select("name","ticket_office");

        return Excel::download(new UsersExport($users), 'usuarios.xlsx');
        
    }

    public function exportLocker(Request $request)
    {
        $users = User::select("name","ticket_office")->where('id', request("id"))->get();

        if (!($users == "[]")){
            return Excel::download(new UsersExport($users), 'usuaro.xlsx');
        } else {
            Log::error('no se ha encontrado la taquilla');
        }
    }
}
