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
            <img src="{{asset('assets/img/logos/logo-omonde.png')}}" alt="Omonde canada">
            <h2>Bonjour {{ $utilisateur->name }} {{ $utilisateur->last_name }} </h2>
        </div>
        <div class="email-body">
            <h3>Votre compte vient d'être crée sur le CRM <span style="font-weight: bold;">Omonde canada</span></h3>
            <ul>
                <li>Code : <span style="font-weight: bold">{{ $utilisateur->code ?? null }}</span></li>
                <li>Poste : {{ $utilisateur->posteOccupe->label ?? null}}</li>
                <li>Succursale : {{ $utilisateur->succursale->label ?? null }}</li>
                <li>Lien de connexion  : {{ route('connexion.form') }}</li>
            </ul>
            <h3>Acces au compte</h3>
            <ul>
                <li>Lien de connexion  : {{ route('connexion.form') }}</li>
                <li>Email : {{ $utilisateur->email ?? null}}</li>
                <li>Mot de passe : {{ $utilisateur->password2 ?? null}}</li>
            </ul>
            <p><span style="font-weight: bold">Omonde canada</span> partout au  monde <span style="color: red">comme chez vous !</span> !</p>
        </div>
        <div class="email-footer">
            <p>&copy; 2024 Omonde canada. Tous droits réservés.</p>
        </div>
    </div>
</body>

</html>
