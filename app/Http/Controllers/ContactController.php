<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }
    
    public function send(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string|max:100',
            'nom' => 'required|string|max:100',
            'email' => 'required|email',
            'sujet' => 'required|string',
            'message' => 'required|string|min:10',
            'rgpd' => 'required|accepted'
        ]);
        
        // Envoyer l'email
        Mail::to('contact@etablissement.fr')
            ->send(new ContactFormMail($request->all()));
        
        // Optionnel : sauvegarder en base de données
        // ContactMessage::create($request->all());
        
        return response()->json([
            'success' => true,
            'message' => 'Votre message a été envoyé avec succès.'
        ]);
    }
}