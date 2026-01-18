<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preinscription;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class PreinscriptionController extends Controller
{
    /**
     * Traiter le formulaire de pré-inscription
     */
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'genre' => 'required|in:M,F',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'nullable|string|max:255',
            'niveau' => 'required|string|in:6eme,5eme,4eme,3eme,2nde,1ere,terminale',
            'parent_nom' => 'required|string|max:255',
            'parent_prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'relation' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'adresse' => 'nullable|string',
            'message' => 'nullable|string|max:1000',
            'conditions' => 'required|accepted',
            'newsletter' => 'nullable|boolean',
        ]);

        try {
            // Créer la pré-inscription
            $preinscription = Preinscription::create([
                'nom' => $validated['nom'],
                'prenom' => $validated['prenom'],
                'genre' => $validated['genre'],
                'date_naissance' => $validated['date_naissance'],
                'lieu_naissance' => $validated['lieu_naissance'] ?? null,
                'niveau_demande' => $validated['niveau'],
                'parent_nom' => $validated['parent_nom'],
                'parent_prenom' => $validated['parent_prenom'],
                'email' => $validated['email'],
                'telephone' => $validated['telephone'],
                'relation' => $validated['relation'] ?? null,
                'profession' => $validated['profession'] ?? null,
                'adresse' => $validated['adresse'] ?? null,
                'message' => $validated['message'] ?? null,
                'newsletter' => $validated['newsletter'] ?? false,
                'statut' => 'en_attente',
                'numero_dossier' => $this->generateNumeroDossier(),
            ]);

            // 1. ENVOYER UN EMAIL À L'ADMIN (ndeyasoxna02@gmail.com)
            $this->sendAdminNotification($preinscription);

            // 2. ENVOYER UN EMAIL DE CONFIRMATION AU PARENT (optionnel)
            $this->sendParentConfirmation($preinscription);

            return redirect()->route('preinscription.confirmation')
                ->with('success', 'Votre pré-inscription a été enregistrée avec succès !')
                ->with('numero_dossier', $preinscription->numero_dossier);

        } catch (\Exception $e) {
            \Log::error('Erreur pré-inscription: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de l\'enregistrement. Veuillez réessayer.');
        }
    }

    /**
     * Envoyer une notification à l'admin
     */
    private function sendAdminNotification(Preinscription $preinscription)
    {
        try {
            // Votre adresse email
            $adminEmail = 'ndeyasoxna02@gmail.com';
            
            // Sujet de l'email
            $subject = 'NOUVELLE PRÉ-INSCRIPTION - ' . $preinscription->numero_dossier;
            
            // Contenu HTML de l'email
            $content = $this->buildAdminEmailContent($preinscription);
            
            // Envoyer l'email
            Mail::raw('', function ($message) use ($adminEmail, $subject, $content, $preinscription) {
                $message->to($adminEmail)
                        ->subject($subject)
                        ->html($content);
            });
            
            \Log::info('Email admin envoyé pour la pré-inscription: ' . $preinscription->numero_dossier);
            
        } catch (\Exception $e) {
            \Log::error('Erreur envoi email admin: ' . $e->getMessage());
        }
    }

    /**
     * Construire le contenu HTML de l'email pour l'admin
     */
    private function buildAdminEmailContent(Preinscription $preinscription)
    {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='utf-8'>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; background: #f9f9f9; padding: 20px; }
                .header { background: linear-gradient(135deg, #1e40af 0%, #ea580c 100%); color: white; padding: 20px; text-align: center; }
                .content { background: white; padding: 20px; border-radius: 5px; margin: 20px 0; }
                .info-table { width: 100%; border-collapse: collapse; }
                .info-table th { background: #f1f5f9; text-align: left; padding: 10px; border-bottom: 1px solid #e2e8f0; }
                .info-table td { padding: 10px; border-bottom: 1px solid #e2e8f0; }
                .highlight { background: #fef3c7; padding: 15px; border-left: 4px solid #f59e0b; margin: 20px 0; }
                .btn { display: inline-block; background: #3b82f6; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
                .footer { text-align: center; margin-top: 20px; color: #64748b; font-size: 12px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>📋 NOUVELLE PRÉ-INSCRIPTION</h1>
                    <p>Ndindy School - Système de Pré-inscription</p>
                </div>
                
                <div class='content'>
                    <div class='highlight'>
                        <h2>⚠️ ACTION REQUISE</h2>
                        <p>Une nouvelle pré-inscription a été soumise sur le site web.</p>
                        <p><strong>Numéro de dossier :</strong> {$preinscription->numero_dossier}</p>
                    </div>
                    
                    <h3>📋 Informations de l'élève</h3>
                    <table class='info-table'>
                        <tr>
                            <th>Nom complet</th>
                            <td>{$preinscription->prenom} {$preinscription->nom}</td>
                        </tr>
                        <tr>
                            <th>Date de naissance</th>
                            <td>" . \Carbon\Carbon::parse($preinscription->date_naissance)->format('d/m/Y') . "</td>
                        </tr>
                        <tr>
                            <th>Genre</th>
                            <td>" . ($preinscription->genre == 'M' ? 'Masculin' : 'Féminin') . "</td>
                        </tr>
                        <tr>
                            <th>Niveau demandé</th>
                            <td>" . strtoupper($preinscription->niveau_demande) . "</td>
                        </tr>
                        <tr>
                            <th>Lieu de naissance</th>
                            <td>" . ($preinscription->lieu_naissance ?? 'Non renseigné') . "</td>
                        </tr>
                    </table>
                    
                    <h3>👨‍👩‍👧‍👦 Informations des parents</h3>
                    <table class='info-table'>
                        <tr>
                            <th>Parent/Tuteur</th>
                            <td>{$preinscription->parent_prenom} {$preinscription->parent_nom}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{$preinscription->email}</td>
                        </tr>
                        <tr>
                            <th>Téléphone</th>
                            <td>{$preinscription->telephone}</td>
                        </tr>
                        <tr>
                            <th>Relation</th>
                            <td>" . ($preinscription->relation ?? 'Non spécifié') . "</td>
                        </tr>
                        <tr>
                            <th>Profession</th>
                            <td>" . ($preinscription->profession ?? 'Non renseignée') . "</td>
                        </tr>
                        <tr>
                            <th>Adresse</th>
                            <td>" . ($preinscription->adresse ?? 'Non renseignée') . "</td>
                        </tr>
                    </table>
                    
                    " . ($preinscription->message ? "
                    <h3>💬 Message complémentaire</h3>
                    <p>{$preinscription->message}</p>
                    " : "") . "
                    
                    <div style='margin-top: 30px; text-align: center;'>
                        <p>
                            <a href='" . url('/admin/preinscriptions') . "' class='btn'>
                                📊 Voir dans l'administration
                            </a>
                        </p>
                        <p style='font-size: 12px; color: #64748b;'>
                            Date de soumission : " . $preinscription->created_at->format('d/m/Y à H:i') . "
                        </p>
                    </div>
                </div>
                
                <div class='footer'>
                    <p>© " . date('Y') . " Ndindy School - Système de gestion des pré-inscriptions</p>
                    <p>Cet email a été généré automatiquement. Veuillez contacter le parent dans les 48h.</p>
                </div>
            </div>
        </body>
        </html>
        ";
    }

    /**
     * Envoyer un email de confirmation au parent
     */
    private function sendParentConfirmation(Preinscription $preinscription)
    {
        try {
            // Si vous voulez aussi envoyer un email au parent
            $subject = 'Confirmation de votre pré-inscription - Ndindy School';
            
            $content = "
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset='utf-8'>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                    .container { max-width: 600px; margin: 0 auto; background: #f9f9f9; padding: 20px; }
                    .header { background: linear-gradient(135deg, #1e40af 0%, #ea580c 100%); color: white; padding: 20px; text-align: center; }
                    .content { background: white; padding: 20px; border-radius: 5px; margin: 20px 0; }
                    .highlight { background: #f0f9ff; padding: 15px; border-left: 4px solid #3b82f6; margin: 20px 0; }
                    .footer { text-align: center; margin-top: 20px; color: #64748b; font-size: 12px; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h1>Ndindy School</h1>
                        <p>Collège & Lycée d'Excellence</p>
                    </div>
                    
                    <div class='content'>
                        <h2>Cher(e) {$preinscription->parent_prenom} {$preinscription->parent_nom},</h2>
                        
                        <p>Nous avons bien reçu votre demande de pré-inscription pour <strong>{$preinscription->prenom} {$preinscription->nom}</strong>.</p>
                        
                        <div class='highlight'>
                            <p><strong>Votre numéro de dossier :</strong></p>
                            <h3 style='color: #1e40af;'>{$preinscription->numero_dossier}</h3>
                            <p>Conservez ce numéro pour tout suivi.</p>
                        </div>
                        
                        <p><strong>Prochaines étapes :</strong></p>
                        <ol>
                            <li>Notre équipe d'admission vous contactera dans les 48h</li>
                            <li>Un entretien sera organisé avec la direction</li>
                            <li>Vous recevrez une réponse définitive sous 5 jours ouvrés</li>
                        </ol>
                        
                        <p><strong>Documents à préparer :</strong></p>
                        <ul>
                            <li>Copie de l'acte de naissance</li>
                            <li>Photo d'identité récente</li>
                            <li>Bulletins des 2 dernières années</li>
                            <li>Certificat de scolarité</li>
                        </ul>
                        
                        <p>Pour toute question, contactez-nous :</p>
                        <p>📞 +221 33 821 45 67<br>
                           📧 inscriptions@ndindy.sn</p>
                    </div>
                    
                    <div class='footer'>
                        <p>© " . date('Y') . " Ndindy School - Tous droits réservés</p>
                        <p>Cet email est envoyé automatiquement, merci de ne pas y répondre.</p>
                    </div>
                </div>
            </body>
            </html>
            ";
            
            Mail::raw('', function ($message) use ($preinscription, $subject, $content) {
                $message->to($preinscription->email)
                        ->subject($subject)
                        ->html($content);
            });
            
        } catch (\Exception $e) {
            \Log::error('Erreur envoi email parent: ' . $e->getMessage());
        }
    }

    /**
     * Générer un numéro de dossier unique
     */
    private function generateNumeroDossier()
    {
        $year = date('Y');
        $lastNumber = Preinscription::whereYear('created_at', $year)->count();
        $nextNumber = $lastNumber + 1;
        
        return 'PRE-' . $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }
}