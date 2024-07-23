<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contrat de Service - Page 1</title>
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
            font-size: 12px;
            margin: 20px;
        }
        .header, .section {
            margin-bottom: 20px;
        }
        .header p, .section p {
            margin: 2px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <div style="float: left; width: 50%;">
            <p>CANADA</p>
            <p>1001 Rang Saint Malo</p>
            <p>G8V 1X4 Trois-Rivières (Québec)</p>
            <p>Bureau : (819) 489-0355</p>
            <p>WhatsApp: (819) 383-2526</p>
        </div>
        <div style="float: right; width: 50%; text-align: right;">
            <p>CÔTE D’IVOIRE</p>
            <p>200 mètres de Abidjan Mall</p>
            <p>à côté de l’Institut Français du Numérique</p>
            <p>Tel : +225 05 02 73 60 88</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="section">
        <h1 style="text-align: center;">CONTRAT DE SERVICE</h1>
        <br><br><br>
        <table class="table">
            <tr>
                <th colspan="3"> <h3>1. CLIENT</h3></th>
            </tr>
            <tr>
                <th>N° DOSSIER</th>
                <th>DOSSIER ANTÉRIEUR</th>
                <th>DATE</th>
            </tr>
            <tr>
                <td>{{$contrat->num_dossier}}</td>
                <td>SANS OBJET</td>
                <td>{{$contrat->date}}</td>
            </tr>
        </table>
    </div>

    <div class="section">

        <table class="table">
            <tr>
                <th colspan="3"> <h3>2. CLIENT</h3></th>
            </tr>
            <tr>
                <th>NOM DE L'AGENT</th>
                <th>EMAIL</th>
                <th>TEL.</th>
            </tr>
            <tr>
                <td>{{ $agent->nom }}</td>
                <td>{{ $agent->email }}</td>
                <td>+1(819) 489-0355</td>
            </tr>
        </table>
    </div>

    <div class="section">

        <table class="table">
            <th colspan="3"> <h3>2. CLIENT</h3></th>
            <tr>
                <th>NOM, PRÉNOM(S)</th>
                <th>CITOYENNETÉ</th>
                <th>PAYS</th>
            </tr>
            <tr>
                <td>{{ $client->nom . ' ' . $client->prenom}}</td>
                <td>IVOIRIENNE</td>
                <td>CÔTE D’IVOIRE</td>
            </tr>
            <tr>
                <th>VILLE</th>
                <th>DATE NAISS.</th>
                <th>EMAIL</th>
            </tr>
            <tr>
                <td>{{ $client->pays }}</td>
                <td>{{ $client->ville }}</td>
                <td>{{ $client->email }}</td>
            </tr>
            <tr>
                <th>TEL.</th>
                <th>OCCUPATION</th>
                <th>STATUT MATRIMONIAL</th>
            </tr>
            <tr>
                <td>{{ $client->tel }}</td>
                <td>{{ $client->occupation }}</td>
                <td>CONJOINT DE FAIT</td>
            </tr>
            <tr>
                <th>NBRE D’ENFANT</th>
                <td colspan="2">4</td>
            </tr>
        </table>
    </div>
</body>
</html>


