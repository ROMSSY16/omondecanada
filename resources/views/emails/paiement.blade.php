<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            background-color: #ffffff;
            padding: 20px;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #fcfcfc;
            padding: 10px 20px;
            border-bottom: 2px solid #e0e0e0;
            text-align: center;
        }

        .email-header img {
            max-width: 150px;
            height: auto;
            margin-bottom: 10px;
        }

        .email-header h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .email-body {
            padding: 20px;
        }

        .email-body h3 {
            font-size: 20px;
            color: #555;
            margin-top: 0;
        }

        .email-body ul {
            list-style: none;
            padding: 0;
        }

        .email-body ul li {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .email-footer {
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }

        .email-footer span {
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100%;
                padding: 10px;
            }

            .email-header img {
                max-width: 120px;
            }

            .email-header h2 {
                font-size: 20px;
            }

            .email-body h3 {
                font-size: 18px;
            }

            .email-body ul li {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <img src="{{asset('assets/img/logos/logo-omonde.png')}}" alt="Omonde Canada">
            <h2>Bonjour {{ $transaction->candidat->nom }} {{ $transaction->candidat->prenom }},</h2>
        </div>
        <div class="email-body">
            <h3>Merci beaucoup pour votre paiement ! Nous avons bien reçu votre transaction de <span style="font-weight: bold; color: blue">{{ $transaction->montant ?? null}} {{ auth()->user()->succursale->devis }}</span> effectuée le <span style="font-weight: bold; color: red">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') }}</span>.</h3>
            <h4>Voici un récapitulatif de votre paiement :</h4>
            <ul>
                <li>Motif : <span style="font-weight: bold;">Frais de consultation</span></li>
                <li>Numéro de transaction : <span style="font-weight: bold;">{{ $transaction->code ?? null }}</span></li>
                <li>Montant total : <span style="font-weight: bold;">{{ $transaction->montant ?? null}}</span></li>
                <li>Mode de paiement : <span style="font-weight: bold;">{{ $transaction->modePaiement->label ?? null }}</span></li>
                <li>Statut de la commande : <span style="font-weight: bold; color: green;">Confirmée</span></li>
            </ul>
            <h4>Votre consultation est prévue le <span style="font-weight: bold; color: red;">{{ \Carbon\Carbon::parse($transaction->candidat->date_rdv)->format('d M Y') }} </span>.</h4>
            
            <p>Chez <span style="font-weight: bold;">Omonde Canada</span>, nous sommes là pour vous accompagner partout dans le monde, <span style="color: red;">comme chez vous !</span></p>
            <p>Si vous avez des questions ou besoin d'assistance supplémentaire, n'hésitez pas à nous contacter.</p>
        </div>
        <div class="email-footer">
            <p>&copy; 2024 Omonde Canada. Tous droits réservés.</p>
        </div>
    </div>
</body>

</html>
