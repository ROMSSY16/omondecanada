
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contrat de Service - Page 3</title>
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
        .section {
            margin-bottom: 20px;
        }
        .section p {
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
        .signature-section {
            margin-top: 40px;
            width: 100%;
            text-align: center;
        }
        .signature-section .signature {
            width: 45%;
            display: inline-block;
            vertical-align: bottom;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 10px;
            border-top: 1px solid #000;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="section">
        <table class="table">
            <tr>
                <th colspan="3"><h3>7. HONORAIRES</h3></th>
            </tr>
            <tr>
                <td colspan="3">7.1 HONORAIRES DE BASE – 4 550 000 FCFA</td>
            </tr>
            <tr>
                <td colspan="3">7.2 LES FRAIS DE DHL, VISITE MÉDICALE OU DE POSTE sont à la charge du client</td>
            </tr>
            <tr>
                <td colspan="3">7.3 LES FRAIS D’UNE REPRISE sont à la charge de OMONDE CANADA, une seule fois uniquement</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <table class="table">
            <tr>
                <th colspan="3"><h3>8. COMMUNICATIONS AVEC LE BUREAU</h3></th>
            </tr>
            <tr>
                <td colspan="3">8.1 PAR EMAIL : Toutes les communications avec OMONDE CANADA par e-mail doivent comporter le numéro du dossier ; le nom du candidat et la raison de la requête.</td>
            </tr>
            <tr>
                <td colspan="3">8.2 PAR APPEL : Le client devra s’assurer que son précèdent appel concernant la même requête a eu lieu au-delà de 21 jours.</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <table class="table">
            <tr>
                <th colspan="3"><h3>9. DOCUMENTS</h3></th>
            </tr>
            <tr>
                <td colspan="3">FORMAT DES DOCUMENTS :</td>
            </tr>
            <tr>
                <td colspan="3">1. Scannés et envoyés par email. En cas de difficulté, le client pourra les envoyer directement au bureau.</td>
            </tr>
            <tr>
                <td colspan="3">2. En format ‘’PDF’’ sauf si on les demande en format ‘’Word’’</td>
            </tr>
            <tr>
                <td colspan="3">3. Tous les documents dans un seul email.</td>
            </tr>
            <tr>
                <td colspan="3">4. Tous les documents identifiés de façon à ce que nous sachions de quoi il s’agit.</td>
            </tr>
            <tr>
                <td colspan="3">5. Avec traduction s’ils ne sont pas en français ou en anglais</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <table class="table">
            <tr>
                <th colspan="3"><h3>10. DÉCLARATION DU CLIENT</h3></th>
            </tr>
            <tr>
                <td colspan="3">• Je comprends et accepte que les honoraires versés au représentant sont des frais administratifs qui permettent de couvrir les frais et dépenses de ma procédure et par conséquent sont non-remboursables.</td>
            </tr>
            <tr>
                <td colspan="3">• Je comprends et accepte que la délivrance du visa est à la seule discrétion d'un officier d'immigration canadienne. Par conséquent, je ne saurai tenir pour responsable OMONDE CANADA pour tout refus.</td>
            </tr>
            <tr>
                <td colspan="3">Tout montant versé par le client pour les services d’un tiers (HONORAIRES DU CONSULTANT OU AVOCAT EN IMMIGRATION, OMONDE CANADA, DHL, FEDEX, UPS, FRAIS DE VISA, FRAIS D’ADMISSION, de CAQ, OUVERTURE DE COMPTE BANCAIRE etc…) et à son bénéfice est non remboursable une fois celui-ci encaissé par ce tiers.</td>
            </tr>
        </table>
    </div>

    <br><br><br><br>
    <div class="section">
        <table class="table">
            <tr>
                <th colspan="3"><h3>11. SIGNATURE</h3></th>
            </tr>
            <tr>
                <td colspan="3">11.1 NON-NÉCESSITÉ :</td>
            </tr>
            <tr>
                <td colspan="3">La signature des contrats n’est plus nécessaire. Le fait pour nous de l’avoir envoyé à la dernière adresse email que nous avons pour le client ou son représentant, et que le client ou son représentant n’ait pas fait d’objection par écrit à notre email d’envoie dans les 48 heures, crée une présomption que ses termes sont acceptés par tous.</td>
            </tr>
            <tr>
                <td colspan="3">11.2 SIGNATURE SI DISPONIBLE :</td>
            </tr>
            <br><br><br><br>
            <tr>
                <td colspan="3">
                    <div class="signature-section">
                        <div class="signature">
                            <p>_______________________________________________</p>
                            <p>Client: {{ $client->nom }} {{ $client->prenom }}</p>
                        </div>
                        <div class="signature">
                            <p>_______________________________________________</p>
                            <p>Agent: {{ $agent->nom }}</p>
                        </div>
                    </div>
                    <div class="signature-section">
                        <p>OMONDE CANADA CIV</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="footer">
        <p>OMONDE CANADA, Firme d'immigration et de recrutement international</p>
        <>1001 Rang Saint Malo, Trois-Rivières, Québec, Canada, G8V 1X4,
        +1 (819) 489 – 0355 | info@omondecanada.com</p>
    </div>
</body>
</html>
