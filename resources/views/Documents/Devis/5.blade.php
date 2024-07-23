<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dernière Page</title>
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
            margin: 40px;
            font-size: 12px;
        }
        .container {
            width: 100%;
        }
        .content {
            margin-top: 20px;
        }
        .content p {
            margin: 10px 0;
            line-height: 1.5;
        }
        .highlight {
            color: red;
        }
        .signature-section {
            margin-top: 40px;
            width: 100%;
            display: table;
        }
        .signature-section div {
            display: table-cell;
            text-align: center;
            vertical-align: bottom;
        }
        .signature {
            padding: 5px;
            width: 40%;
        }
        .signature-section .candidate {
            padding-right: 10%;
        }
        .signature-section .company {
            padding-left: 10%;
        }
        .footer {
            text-align: center;
            margin-top: 18rem;
            font-size: 10px;
            border-top: 1px solid #000;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            @php
                // Calculer la somme des montants des entrées pour ce candidat
               $montantPaye = \App\Models\Entree::where('id_candidat', $candidat->id)->where('id_type_paiement', 1)->sum('montant');
                
                // Calculer le montant payé en fonction du type de procédure
                $totalMontant  = $candidat->proceduresDemandees->montant ;
                
                // Calculer le montant restant
                $reste = $totalMontant - $montantPaye;

                $recuPrefix = 'RC';
    $datePart = \Carbon\Carbon::parse($candidat->date_versement)->format('Ymd');
    $numeroRecu = "{$recuPrefix}-{$datePart}-{$candidat->id}";

            @endphp
            <p>Versement pour la demande du visa de résidence permanente au Canada – <strong>OMONDE CANADA</strong></p>
            <p>Effectué par <strong>ESPÈCES</strong></p>
            <p>à l’institution « <strong>OMONDE CANADA – CÔTE D’IVOIRE</strong> »</p>
            <p>En date du <strong>{{ \Carbon\Carbon::parse($candidat->date_versement)->format('d/m/Y') }}</strong></p>
            <p>Le montant est de <strong class="highlight">{{ number_format($totalMontant, 0, ',', ' ') }} F CFA</strong></p>
            <p>Il reste donc <strong class="highlight">{{ number_format($reste, 0, ',', ' ') }} F CFA</strong></p>
            <p>Le numéro du reçu de versement est <strong>{{ $numeroRecu }}</strong></p>  <p>Le client reconnaît que ces frais ne sont pas remboursables car ils serviront pour le traitement de sa demande d’immigration au Canada.</p>
            <h3>ACCEPTATION DU DEVIS</h3>
            <p class="highlight">Ce document doit être signé avec la mention : Lu et approuvé (en 2 exemplaires). Le cas échéant ce document sera envoyé par voie électronique. Nous attestons que nos signatures garderont la même force et validité que si elles avaient été signées sur une même copie papier du contrat.</p>
        </div>
        <div class="signature-section">
            <div class="candidate signature">
                <p>_______________________________________________</p>
                <p>{{ $candidat->nom }} {{ $candidat->prenom }}</p>
            </div>
            <div class="company signature">
                <p>_______________________________________________</p>
                <p>OMONDE CANADA</p>
            </div>
        </div>
        <div class="footer">
            <p>OMONDE CANADA, Firme d'immigration et de recrutement international</p>
            <p>1001 Rang Saint Malo, Trois-Rivières, Québec, Canada, G8V 1X4</p>
            <p>+1 (819) 489 – 0355 | info@omondecanada.com</p>
        </div>
    </div>
</body>
</html>

