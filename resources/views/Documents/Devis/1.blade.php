<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Première Page</title>
    <style>
        @font-face {
            font-family: 'Lato';
            font-style: normal;
            font-weight: 400;
            src: url('{{ storage_path('fonts/Lato-Regular.ttf') }}') format('truetype');
        }
        @font-face {
            font-family: 'Lato';
            font-style: italic;
            font-weight: 400;
            src: url('{{ storage_path('fonts/Lato-Italic.ttf') }}') format('truetype');
        }
        @font-face {
            font-family: 'Lato';
            font-style: normal;
            font-weight: 700;
            src: url('{{ storage_path('fonts/Lato-Bold.ttf') }}') format('truetype');
        }
        body {
            font-family: 'Lato', sans-serif;
            margin: 0;
            padding: 20px;
            width: 100%;
            box-sizing: border-box;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header .info {
            text-align: right;
            font-size: 12px;
            margin-top: 0;
        }
        .header img {
            max-width: 150px;
        }
        .main-logo {
            text-align: center;
            margin: 20px 0;
        }
        .main-logo img {
            max-width: 150px;
        }
        .title {
            text-align: center;
            color: red;
            font-size: 24px;
            margin: 10px 0;
        }
        .flag {
            text-align: center;
            margin: 20px 0;
        }
        .flag img {
            display: block;
            margin: 0 auto;
            max-width: 450px;
        }
        .content {
            text-align: center;
            margin: 40px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            text-align: center;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 10px;
        }
        .table th {
            width: 30%;
            background-color: #f2f2f2;
        }
        .table td {
            text-align: center;
            vertical-align: bottom;
        }
        .table .full-width {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('assets/img/logos/logo-omonde.png') }}" alt="Logo">
        <div class="info">
            <p>1001 Rang Saint Malo, Trois-Rivières, Québec</p>
            <p>Canada, G8V 1X4</p>
            <p>+1 (819) 489 – 0355</p>
            <p>info@omondecanada.com</p>
        </div>
    </div>
    <h2 class="title">
        IMMIGRER AU CANADA
    </h2>
    <div class="main-logo">
        <img src="{{ public_path('assets/img/logos/logo-omonde.png') }}" alt="Logo Principal">
    </div>
    <div class="flag">
        <img src="{{ public_path('assets/Flag.png') }}" alt="Drapeau">
    </div>
    <div class="content">
        <table class="table">
            <tr>
                <th colspan="2" class="full-width">CANDIDAT</th>
                <td colspan="2" class="full-width">{{ $candidat->nom }} {{ $candidat->prenom }}</td>
            </tr>
            <tr>
                <th>NOM DU CANDIDAT</th>
                <td>{{ $candidat->nom }}</td>
                <th>NUMÉRO DE TÉLÉPHONE</th>
                <td>{{ $candidat->numero_telephone }}</td>
            </tr>
            <tr>
                <th>PRÉNOM(S) DU CANDIDAT</th>
                <td>{{ $candidat->prenom }}</td>
                <th>RAISON DU VOYAGE</th>
                <td> {{ $candidat->proceduresDemandees->typeProcedure->label }}</td>
            </tr>
            <tr>
                <th>NOMBRE DE PERSONNE</th>
                <td>{{ $candidat->number_of_people ?? 1 }}</td>
                <th>NUMÉRO DE DOSSIER</th>
                <td>{{ substr($candidat->nom, 0, 1) }}{{ substr($candidat->prenom, 0, 1) }}{{ \Carbon\Carbon::parse($candidat->date_naissance)->format('dmy') }}</td>
            </tr>
        </table>
    </div>
</body>
</html>

