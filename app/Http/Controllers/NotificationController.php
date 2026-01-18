<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    /**
     * Afficher toutes les notifications
     */
    public function index()
    {
        $user = Auth::user();
        
        // Récupérer les notifications depuis la base de données
        // Si vous utilisez le système de notifications Laravel
        if (method_exists($user, 'notifications')) {
            $notifications = $user->notifications()
                ->orderBy('created_at', 'desc')
                ->paginate(20);
            
            // Marquer comme lues
            $user->unreadNotifications->markAsRead();
        } else {
            // Fallback pour les notifications personnalisées
            $notifications = DB::table('notifications')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }
        
        return view('notifications.index', compact('notifications'));
    }
    
    /**
     * Marquer une notification comme lue
     */
    public function markAsRead($id)
    {
        $user = Auth::user();
        
        if (method_exists($user, 'notifications')) {
            $notification = $user->notifications()->find($id);
            if ($notification) {
                $notification->markAsRead();
            }
        } else {
            DB::table('notifications')
                ->where('id', $id)
                ->where('user_id', $user->id)
                ->update(['read_at' => now()]);
        }
        
        return back()->with('success', 'Notification marquée comme lue');
    }
    
    /**
     * Marquer toutes les notifications comme lues
     */
    public function markAllAsRead()
    {
        $user = Auth::user();
        
        if (method_exists($user, 'notifications')) {
            $user->unreadNotifications->markAsRead();
        } else {
            DB::table('notifications')
                ->where('user_id', $user->id)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
        }
        
        return back()->with('success', 'Toutes les notifications ont été marquées comme lues');
    }
    
    /**
     * Supprimer une notification
     */
    public function destroy($id)
    {
        $user = Auth::user();
        
        if (method_exists($user, 'notifications')) {
            $user->notifications()->find($id)->delete();
        } else {
            DB::table('notifications')
                ->where('id', $id)
                ->where('user_id', $user->id)
                ->delete();
        }
        
        return back()->with('success', 'Notification supprimée');
    }
    
    /**
     * Supprimer toutes les notifications
     */
    public function clearAll()
    {
        $user = Auth::user();
        
        if (method_exists($user, 'notifications')) {
            $user->notifications()->delete();
        } else {
            DB::table('notifications')
                ->where('user_id', $user->id)
                ->delete();
        }
        
        return back()->with('success', 'Toutes les notifications ont été supprimées');
    }
    
    /**
     * Obtenir le nombre de notifications non lues (pour AJAX/API)
     */
    public function unreadCount()
    {
        $user = Auth::user();
        
        if (method_exists($user, 'notifications')) {
            $count = $user->unreadNotifications()->count();
        } else {
            $count = DB::table('notifications')
                ->where('user_id', $user->id)
                ->whereNull('read_at')
                ->count();
        }
        
        return response()->json(['count' => $count]);
    }
}