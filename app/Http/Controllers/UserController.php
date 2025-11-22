<?php

namespace App\Http\Controllers;
use App\Models\Center;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $paginateNumber = 21;
    public function index()
    {
        $totalUsers = User::count();
        // $activeUsers = User::active()->count();
        // $inactiveUsers = User::inactive()->count();
        
        $users = User::orderBy('created_at', 'desc')->paginate(21);

        return view("users.index", compact(
            'totalUsers', 
        //    'activeUsers', 
        //    'inactiveUsers',
            'users'
        ));
    }

    public function search(Request $request)
    {
        $pagination = "";
        $htmlContent = "";
        // Se obtiene la pagina, sino, se usa la pagina 1
        $page = $request->input("page", 1);
        $searchValue = $request->searchValue;
        $searchUsers = User::where("name", "like" , "%$searchValue%")->paginate($this->paginateNumber, ["*"], "page", $page);
        if (!empty($searchUsers)) {
            foreach ($searchUsers as $user) {
                $htmlContent .= view("components.user-card", compact("user"))->render();
            }
            // Se obtiene la paginacion
            $pagination = $searchUsers->links()->render();
        }
        return response()->json(["htmlContent" => $htmlContent, "pagination" => $pagination]);
    }

    public function filter(Request $request)
    {
        $page = $request->input("page", 1);
        $order = $request->input("order", null);
        $status = $request->input("status", null);
        $query = User::query();

        // Se obtiene el filtro del estado y se añade a la query
        if ($status == "active") {
            $query->where("is_active", true);
        } elseif ($status == "inactive") {
            $query->where("is_active", false);
        }

        // Se comprueba que tipo de orden se envia y se añade a la query
        switch ($order) {
            case "recent-first":
                $query->orderBy("created_at", "desc");
                break;
            case "oldest-first":
                $query->orderBy("created_at", "asc");
                break;
            case "az":
                $query->orderBy("name", "asc");
                break;
            case "za":
                $query->orderBy("name", "desc");
                break;
            case "last-modified":
                $query->orderBy("updated_at", "desc");
                break;
            case "first-modified":
                $query->orderBy("updated_at", "asc");
                break;
        }

        // Se pagina la query
        $users = $query->paginate($this->paginateNumber, ["*"], "page", $page);

        // Lo mismo que con search, se obtienen los cursos que se obtienen en la query
        $htmlContent = "";
        foreach ($users as $user) {
            $htmlContent .= view("components.user-card", compact("user"))->render();
        }
        $pagination = $users->links()->render();

        return response()->json(["htmlContent" => $htmlContent, "pagination" => $pagination]);
    }

    public function create()
    {
        $user = new User();
        return view('users.create', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:9',
            'role' => 'required|in:technical_team,management_team,administration,professional',
            'status' => 'required|in:active,inactive,substitute',
            'locker' => 'required|string',
            'locker_password' => 'required|string',
            'password' => 'required|min:8',
        ]);
        $validated["center"]=1;

        $validated['password'] = Hash::make($validated['password']);
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
            return redirect()->route("dashboard")->with('success', 'Sessió iniciada correctament');
        } else{
            return back()->with("error", "Usuari o contrasenya incorrectes")->withInput();
        }
    }

    public function exportAllLockers()
    {
        $users = User::all()->select("name","locker");

        return Excel::download(new UsersExport($users), 'taquillas.xlsx');
        
    }

    public function exportLocker($userId)
    {
        $users = User::select("name","locker")->where('id', $userId)->get();

        if (!($users == "[]")){
            return Excel::download(new UsersExport($users), 'taquilla.xlsx');
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