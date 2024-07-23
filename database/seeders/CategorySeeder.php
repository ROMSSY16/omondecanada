<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'RENSEIGNEMENTS PERSONNELS',
            'COORDONNEES',
            'SITUATION FAMILIALE',
            'SCOLARITE',
            'PARCOURS PROFESSIONNEL (5 dernières années)',
            'OFFRE D\'EMPLOI VALIDEE PAR LE MINISTRE',
            'CONNAISSANCES LINGUISTIQUES'
        ];

        $questions = [
            'RENSEIGNEMENTS PERSONNELS' => [
                'Nom sur le passeport',
                'Prénoms sur le passeport',
                'Sexe',
                'Date de naissance',
                'Ville de naissance',
                'Pays de naissance',
                'Langue parlée',
                'Citoyenneté',
                'Numéro de passeport',
                'Date de délivrance du passeport',
                'Date d\'expiration du passeport',
                'Numéro de la pièce d\'identité',
                'Date de délivrance de la pièce d\'identité',
                'Date d\'expiration de la pièce d\'identité',
                'Pays émetteur du passeport',
                'Numéro de référence auprès MIFI',
                'Numéro de référence auprès du IRCC'
            ],
            'COORDONNEES' => [
                'Adresse',
                'Pays',
                'Ville'
            ],
            'SITUATION FAMILIALE' => [
                'Etat matrimonial actuel',
                'Si marié, quelle est la date de mariage ?',
                'Si marié, serez-vous accompagné(e) par votre conjoint',
                'Si oui : veuillez fournir',
                'Nom et prénom(s) sur le passeport',
                'Sexe',
                'Date de naissance',
                'Nom et prénoms du père',
                'Date de naissance du père',
                'Nom et prénoms de la mère',
                'Date de naissance de la mère',
                'Numéro de référence auprès du MIFI',
                'Numéro de référence auprès du IRCC',
                'Avez-vous des enfants qui vous accompagnent ?'
            ],
            'SCOLARITE' => [
                'Avez-vous un diplôme supérieur aux études primaires ?',
                'Avez-vous une évaluation comparative des études effectuées hors du Québec émise après le 31 janvier 2013',
                'Informations sur le diplôme',
                'a-Nom de l\'établissement',
                'b-Titre du diplôme',
                'c-Pays ou territoire émetteur du diplôme',
                'd-Etudes commencées le : AAAA-MM-JJ',
                'e-Etudes réussies le : AAAA-MM-JJ',
                'Informations sur le diplôme',
                'a-Nom de l\'établissement',
                'b-Titre du diplôme',
                'c-Pays ou territoire émetteur du diplôme',
                'd-Etudes commencées le : AAAA-MM-JJ',
                'e-Etudes réussies le : AAAA-MM-JJ',
                'Informations sur le diplôme',
                'a-Nom de l\'établissement',
                'b-Titre du diplôme',
                'c-Pays ou territoire émetteur du diplôme',
                'd-Etudes commencées le : AAAA-MM-JJ',
                'e-Etudes réussies le : AAAA-MM-JJ'
            ],
            'PARCOURS PROFESSIONNEL (5 dernières années)' => [
                'Date de début et de fin',
                'Occupation (Temps plein/temps partiel/stage/congés parental/arrêt de travail/sans emploi/bénévolat)',
                'Type d\'emploi (salarié/entrepreneur/travailleur autonome/emploi à commission)',
                'Titre de l\'emploi',
                'Nom de l\'entreprise',
                'Êtes-vous propriétaire de l\'entreprise ?',
                'Pays',
                'Nombre moyen d\'heures travaillées par semaine',
                'Code de la classification nationale des professions',
                'Appellation de l\'emploi'
            ],
            'OFFRE D\'EMPLOI VALIDEE PAR LE MINISTRE' => [
                'Avez-vous une offre d\'emploi validée par le ministre ?',
                'Si oui, quel est le numéro de dossier ?'
            ],
            'CONNAISSANCES LINGUISTIQUES' => [
                'Êtes-vous en mesure de démontrer vos connaissances linguistiques en français par un diplôme ou une attestation de résultats d\'un test reconnu par le ministre, obtenu depuis moins de 2 ans',
                'Êtes-vous en mesure de démontrer vos connaissances linguistiques en anglais par un diplôme ou une attestation de résultats d\'un test reconnu par le ministre, obtenu depuis moins de 2 ans'
            ]
        ];

        foreach ($categories as $categoryName) {
            $category = Category::create(['name' => $categoryName]);

            foreach ($questions[$categoryName] as $questionText) {
                Question::create([
                    'category_id' => $category->id,
                    'question' => $questionText
                ]);
            }
        }
    }
}
