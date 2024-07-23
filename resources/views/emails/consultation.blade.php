<!DOCTYPE html>
<html>
<head>
    <title>Mise à jour de la consultation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #2c3e50;
        }
        p {
            margin: 10px 0;
        }
        .details {
            background-color: #ecf0f1;
            padding: 10px;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bonjour,</h1>
        <p>Nous souhaitons vous informer que la consultation a été <strong>{{ $action }}</strong>.</p>
        <div class="details">
            <p><strong>Détails de la consultation :</strong></p>
            <p><strong>Lien Zoom :</strong> {{ $lien_zoom }}</p>
            <p><strong>Lien pour démarrer :</strong> {{ $lien_zoom_demarrer }}</p>
            <p><strong>Date et Heure :</strong> {{ $date }}</p>
            <p><strong>Nombre de participants :</strong> {{ $nombre_candidats }}</p>
            <p><strong>Consultante :</strong> {{ $consultante }}</p>
        </div>
        <p>Cordialement,<br>OMONDE CANADA.</p>
        <div class="footer">
            <p>Veuillez ne pas répondre à cet e-mail. Pour toute question ou assistance, veuillez contacter notre support.</p>
        </div>
    </div>
</body>
</html>
