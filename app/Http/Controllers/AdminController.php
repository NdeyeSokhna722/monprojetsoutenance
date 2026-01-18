<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Afficher le profil admin
     */
    public function profile()
    {
        $user = auth()->user();
        
        // Statistiques (exemple)
        $stats = [
            'totalUsers' => User::count(),
            'teachers' => User::where('role', 'teacher')->count(),
            'students' => User::where('role', 'student')->count(),
            'activeUsers' => User::where('is_active', true)->count(),
        ];
        
        return view('admin.profile', compact('user', 'stats'));
    }

    /**
     * Dashboard admin
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    
    // Ajoutez d'autres méthodes selon vos besoins
}