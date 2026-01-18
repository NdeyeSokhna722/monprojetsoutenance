<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirmation de pré-inscription</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(to right, #1d4ed8, #ea580c); color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f9fafb; padding: 30px; border-radius: 0 0 10px 10px; }
        .info-box { background: white; border-left: 4px solid #1d4ed8; padding: 15px; margin: 20px 0; }
        .footer { margin-top: 30px; text-align: center; font-size: 0.9em; color: #6b7280; }
        .btn { display: inline-block; background: #ea580c; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Ndindy School</h1>
            <h2>Confirmation de pré-inscription</h2>
        </div>
        
        <div class="content">
            <p>Bonjour {{ $preinscription->parent_prenom }} {{ $preinscription->parent_nom }},</p>
            
            <p>Nous avons bien reçu votre demande de pré-inscription pour <strong>{{ $preinscription->prenom }} {{ $preinscription->nom }}</strong>.</p>
            
            <div class="info-box">
                <h3>Détails de la pré-inscription :</h3>
                <p><strong>Numéro de dossier :</strong> {{ $preinscription->numero_dossier }}</p>
                <p><strong>Élève :</strong> {{ $preinscription->prenom }} {{ $preinscription->nom }}</p>
                <p><strong>Niveau demandé :</strong> {{ $preinscription->niveau_demande }}</p>
                <p><strong>Date de naissance :</strong> {{ $preinscription->date_naissance->format('d/m/Y') }}</p>
            </div>
            
            <p>Notre équipe d'admission va examiner votre demande et vous contactera dans les 48 heures pour fixer un rendez-vous.</p>
            
            <p>En attendant, vous pouvez préparer les documents suivants :</p>
            <ul>
                <li>Copie de l'acte de naissance</li>
                <li>Photo d'identité récente</li>
                <li>Bulletins des 2 dernières années</li>
                <li>Certificat de scolarité</li>
            </ul>
            
            <p>Pour toute question, vous pouvez nous contacter :</p>
            <ul>
                <li>📞 +221 77 726 84 19</li>
                <li>📧 inscriptions@ndindy.sn</li>
            </ul>
            
            <p>Cordialement,<br>
            <strong>L'équipe d'admission de Ndindy School</strong></p>
            
            <div class="footer">
                <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
                <p>© {{ date('Y') }} Ndindy School. Tous droits réservés.</p>
            </div>
        </div>
    </div>
</body>
</html>