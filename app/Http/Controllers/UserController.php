<?php

namespace App\Http\Controllers;
use App\Models\Center;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $activeUsers = User::active()->count();
        $inactiveUsers = User::inactive()->count();
        
        $users = User::orderBy('created_at', 'desc')->get();

        return view("users.index", compact(
            'totalUsers', 
            'activeUsers', 
            'inactiveUsers',
            'users'
        ));
    }

    public function create()
    {
        $centers = Center::all(); // Obtener todos los centros
        return view('users.create', compact('centers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:9',
            'role' => 'required|in:technical_team,management_team,administration,professional',
            'status' => 'required|in:active,inactive,substitute',
            'locker' => 'required|integer',
            'locker_password' => 'required|string',
            'password' => 'required|min:8',
        ]);
        $validated["center"]=1;

        $validated['password'] = bcrypt($validated['password']);
        $validated['is_active'] = true;

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'Professional creat correctament.');
    }

    public function show(User $user)
    {
        return view("users.show", compact("user"));
    }

    public function edit(User $user)
    {
        $centers = Center::all(); // Obtener todos los centros
        return view('users.edit', compact('user', 'centers'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:9',
            'role' => 'required|in:technical_team,management_team,administration,professional',
            'status' => 'required|in:active,inactive,substitute',
            'locker' => 'required|integer',
            'locker_password' => 'required|string',
            'password' => 'required|min:8',
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Professional actualitzat correctament.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Professional eliminat correctament.');
    }

    public function deactivate(User $user)
    {
        $user->update(['is_active' => false]);
        return redirect()->route('users.index')->with('success', 'Professional desactivat correctament.');
    }

    public function activate(User $user)
    {
        $user->update(['is_active' => true]);
        return redirect()->route('users.index')->with('success', 'Professional activat correctament.');
    }

    public function showLoginForm()
    {
        $centers = Center::all();
        return view("auth.login", compact("centers"));
    }

    public function login(Request $request)
    {
        $request->validate([
            "center" => "required|exists:centers,id",
            "email" => "required",
            "password" => "required"
        ]);

        if(Auth::attempt(["email" => $request->email, "password" => $request->password])){
            return redirect()->route("dashboard");
        } else{
            return redirect()->route("login")->withErrors(["email" => "Las credenciales son incorrectas"]);
        }
    }

    public function exportAllLockers()
    {
        $users = User::all()->select("name","locker");

        return Excel::download(new UsersExport($users), 'usuarios.xlsx');
        
    }

    public function exportLocker($userId)
    {
        $users = User::select("name","locker")->where('id', $userId)->get();

        if (!($users == "[]")){
            return Excel::download(new UsersExport($users), 'usuaro.xlsx');
        } else {
            Log::error('no se ha encontrado la taquilla');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route("login");
    }
}