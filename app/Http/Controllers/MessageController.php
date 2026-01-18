<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        // Récupérer les conversations (les derniers messages échangés avec chaque utilisateur)
        $conversations = Message::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->with(['sender', 'receiver'])
            ->latest()
            ->get()
            ->groupBy(function ($message) {
                return $message->sender_id == Auth::id() ? $message->receiver_id : $message->sender_id;
            });

        return view('messages.index', compact('conversations'));
    }

    public function show(User $user)
    {
        // Récupérer les messages entre l'utilisateur connecté et l'utilisateur sélectionné
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', Auth::id());
        })->latest()->get();

        // Marquer les messages non lus comme lus
        Message::where('sender_id', $user->id)
            ->where('receiver_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('messages.show', compact('messages', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'receiver_id' => 'required|exists:users,id',
        ]);

        Message::create([
            'content' => $request->content,
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
        ]);

        return redirect()->route('messages.show', $request->receiver_id)->with('success', 'Message envoyé.');
    }
}
