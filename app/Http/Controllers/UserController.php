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
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        // Se obtiene el parametro status en la request, si existe se aplic el filtro
        $status = $request->input("status");
        if ($status == "active") {
            $query->where("is_active", true);
        } elseif ($status == "inactive") {
            $query->where("is_active", false);
        }

        $users = $query->orderBy("created_at", "desc")->get();

        $viewType = $_COOKIE["view_type"] ?? "card";

        return view("users.index", compact( "users", "viewType"));
    }

    public function search(Request $request)
    {
        $htmlContent = "";
        $searchValue = $request->searchValue;
        $orderBy = $request->orderBy;
        $status = $request->status;

        $query = User::query();

        if ($searchValue) {
            $query->where("name", "like", "%$searchValue%");
        }

        if ($status == "active") {
            $query->where("is_active", true);
        } elseif ($status == "inactive") {
            $query->where("is_active", false);
        }

        switch ($orderBy) {
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
            default:
                $query->orderBy("created_at", "desc");
        }

        $users = $query->get();

        if ($users->isNotEmpty()) {
            $viewType = $_COOKIE['view_type'] ?? "card";
            if ($viewType == "card") {
                foreach ($users as $user) {
                    $htmlContent .= view("components.user-card", compact("user"))->render();
                }
            } else {
                foreach ($users as $user) {
                    $htmlContent .= view("components.user-table", compact("user"))->render();
                }
            }
        }
        
        return response()->json(["htmlContent" => $htmlContent]);
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
            'role' => 'required|in:responsable_equip_tecnic,equip_directiu,administracio',
            'status' => 'required|in:active,inactive,substitute',
            'locker' => 'required|string',
            'locker_password' => 'required|string',
            'password' => 'required|min:8',
        ]);
        $validated["center"]= auth()->user()->center;

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
            'role' => 'required|in:responsable_equip_tecnic,equip_directiu,administracio',
            'status' => 'required|in:active,inactive,substitute',
            'locker' => 'required|integer',
            'locker_password' => 'required|string',
            'password' => 'required|min:8',
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Professional actualitzat correctament.');
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

    public function updateProfilePhoto(Request $request, User $user)
    {
        $error = null;
        $path = null;

        // Caso de archivo subido
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');

            if (!$file->isValid() || !in_array($file->extension(), ["jpg","jpeg","png","gif","bmp","webp"])) {
                $error = "El fitxer ha de ser una imatge vàlida";
            } elseif ($file->getSize() > 5120 * 1024) {
                $error = "La imatge no pot pesar més de 5MB.";
            } else {
                $path = $file->store("profile_photos", "public");
            }

        // Caso de base64
        } elseif ($request->input("profile_photo")) {
            $data = $request->input("profile_photo");

            if (strpos($data, "data:image") !== 0 || strpos($data, "base64,") === false) {
                $error = "El fitxer ha de ser una imatge vàlida";
            } else {
                $data = explode('base64,', $data)[1];
                $data = str_replace(" ", "+", $data);

                $fileName = "profile_" . $user->id . "_" . time() . ".png";
                $path = "profile_photos/" . $fileName;
                Storage::disk("public")->put($path, base64_decode($data));
            }

        } else {
            $error = "La imatge no pot pesar més de 5MB";
        }

        // Si hubo error, redirigir con mensaje
        if ($error) {
            return redirect()->back()->with('error', $error);
        }

        // Se elimina la foto antigua si existe
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $user->update(["profile_photo_path" => $path]);

        return redirect()->back()->with("success", "Foto de perfil actualitzada correctament");
    }


    public function showLoginForm()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $request->validate([
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
    public function switchCenter(Request $request) {
        if (auth()->user()->role == "equip_directiu") {
            $request->validate([
                "center_id" => "required|exists:centers,id"
            ]);
            session(["active_center_id" => $request->center_id]);
            return back()->with("success", "Centre canviat correctament");
        } else {
            return back()->with("error", "No tens permisos per canviar de centre");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route("login");
    }
}