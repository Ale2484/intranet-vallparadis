<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $activeUsers = User::active()->count();
        $inactiveUsers = User::inactive()->count();
        
        // Todos los profesionales mezclados, ordenados por creación
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
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:9',
            'role' => 'required|in:technical_team,management_team,administration,professional',
            'center' => 'required|exists:centers,id',
            'status' => 'required|in:active,inactive,substitute',
            'ticket_office' => 'required|integer',
            'locker_password' => 'required|string',
            'password' => 'required|min:8',
        ]);

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
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:9',
            'role' => 'required|in:technical_team,management_team,administration,professional',
            'center' => 'required|exists:centers,id',
            'status' => 'required|in:active,inactive,substitute',
            'ticket_office' => 'required|integer',
            'locker_password' => 'required|string',
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
}