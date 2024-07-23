<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu de Paiement</title>
    <style>
        @font-face {
            font-family: 'Ubuntu';
            src: url('{{ storage_path('fonts/Ubuntu-Regular.ttf') }}') format('truetype');
        }
        body {
            font-family: 'Ubuntu', sans-serif;
            padding: 2rem;
        }
        .receipt {
            max-width: 800px;
            margin: 0 auto 40px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #ddd;
            border-radius: 8px;
        }
        .header-table, .footer-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .header-table td, .footer-table td {
            vertical-align: middle;
        }
        .header-table img, .footer-table img {
            max-width: 150px;
        }
        .header-table h3 {
            margin: 0;
            text-align: center;
        }
        .header-table p {
            text-align: center;
            margin-top: 5px;
        }
        .receipt-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .receipt-details table, .receipt-details th, .receipt-details td {
            border: 1px solid #c3c3c3;
            background-color: #fff;
            border-radius: 4px;
        }
        .receipt-details th, .receipt-details td , tr{
            padding: 8px;
            text-align: left;
        }
        .footer-table .footer-left, .footer-table .footer-right {
            width: 50%;
            text-align: center;
        }

        .company-info {
            font-size: 14px;
            text-align: center;
        }
        .company-info p {
            margin: 5px 0;
        }
        .company-info img {
            max-width: 100px;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <table class="header-table">
            <tr>
                <td><img src="{{ public_path('assets/img/logos/logo-omonde.png') }}" alt="Logo Principal"></td>
                <td>
                    <h2>Reçu de Paiement</h2>
                    <!-- Dans votre vue Documents.Recu.blade.php -->

<p>Date : {{ \Carbon\Carbon::parse($transaction->date)->locale('fr')->isoFormat('LL') }}</p>
</td>
            </tr>
        </table>
        <div class="receipt-details">
            <table>
                <tr>
                    <th>NOM ET PRÉNOM(S):</th>
                    <td>{{ $transaction->candidat->nom }} {{ $transaction->candidat->prenom }}</td>
                </tr>
                <tr>
                    <th>MONTANT REGLÉ:</th>
                    <td>{{ number_format($transaction->montant, 0, ',', ' ') }} @if ($transaction->utilisateur->id_succursale == 4) $ @else F CFA @endif</td>
                </tr>
                <tr>
                    <th>MOTIF DE PAIEMENT:</th>
                    <td>{{ \App\Models\TypePaiement::where('id', $transaction->id_type_paiement)->value('label') }}</td>
                </tr>
                <tr>
                    <th>MOYEN DE PAIEMENT:</th>
                    <td> {{$transaction->ModePaiement->label}}</td>
                </tr>
                <tr>
                    <th>NUMÉRO DE DOSSIER:</th>
                    <td>{{ $transaction->id }}</td>
                </tr>
            </table>
        </div>
        <table class="footer-table">
            <tr>

                <td class="footer-right">
                    <p>NB : Le paiement est <strong>non remboursable</strong></p>
                </td>
            </tr>
        </table>
        <div class="company-info">
             <p>Email : info@omondecanada.com</p>
            <p>200m de Abidjan Mall, à côté de l'institut français du numérique</p>
            <p>Tel : +225 07 89 30 20 15 / +225 05 02 73 60 88 / +225 07 05 10 85 09</p>
        </div>
    </div>
</body>
</html>
