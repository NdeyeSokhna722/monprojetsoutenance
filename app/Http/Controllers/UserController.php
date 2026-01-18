<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function index(Request $request)
{
    // Commencer la requête
    $query = User::query();
    
    // Recherche par nom ou email
    if ($request->has('search') && $request->search != '') {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
        });
    }
    
    // Filtre par rôle
    if ($request->has('role') && $request->role != '') {
        $query->where('role', $request->role);
    }
    
    // Pagination
    $users = $query->orderBy('created_at', 'desc')->paginate(10);
    
    // Compter les statistiques (toujours sur tous les utilisateurs)
    $totalUsers = User::count();
    $adminCount = User::where('role', 'admin')->count();
    $teacherCount = User::where('role', 'teacher')->count();
    $studentCount = User::where('role', 'student')->count();
    
    return view('users.index', compact(
        'users', 
        'totalUsers', 
        'adminCount', 
        'teacherCount', 
        'studentCount'
    ));
}

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $data = $request->only(['name', 'email']);

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé.');
    }
}
