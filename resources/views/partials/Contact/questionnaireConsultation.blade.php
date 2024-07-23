<div class="questionnaire-form" style="display: none;">
                    
    <h4>Questionnaire supplémentaire</h4>

 <!-- Type de visa -->
    <div class="mb-3">
        <label class="form-label">Quel type de visa desirez-vous ?</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="type_visa" id="etudiant" value="etudiant">
            <label class="form-check-label" for="etudiant">Étudiant</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="type_visa" id="travailleur" value="travailleur">
            <label class="form-check-label" for="travailleur">Travailleur</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="type_visa" id="visiteur" value="visiteur">
            <label class="form-check-label" for="visiteur">Visiteur</label>
        </div>
    </div>
    <div class="input-group input-group-outline mb-3 p-2">
        <label for="date_naissance_conjoint" class="form-label">2- Quelle est votre date de naissance ?</label>
        <input type="date" name="date_naissance" id="date_naissance" class="form-control">
    </div>
    
    
    <!-- Question 1 -->
    <div class="mb-3">
        <label class="form-label">1- Statut matrimonial</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="statut_matrimonial"
                id="celibataire" value="Celibataire" >
            <label class="form-check-label" for="celibataire">Célibataire</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="statut_matrimonial"
                id="marie" value="Marie" >
            <label class="form-check-label" for="marie">Marié</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="statut_matrimonial"
                id="fiance" value="Fiance" >
            <label class="form-check-label" for="fiance">Fiancé(e)</label>
        </div>
    </div>
    
    <!-- Question 2  et 3n- Avez-vous un passeport valide ? -->
    <div class="mb-3">
        <label class="form-label">2- Avez-vous un passeport valide ?</label>
        <div class="form-check">
            <!-- Option "Oui" -->
            <input class="form-check-input" type="radio" name="passeport_valide"
                id="passeport_valide_oui" value="oui">
            <label class="form-check-label" for="passeport_valide_oui">Oui</label>

        </div>

        <div class="form-check">
            <!-- Option "Non" -->
            <input class="form-check-input" type="radio" name="passeport_valide"
                id="passeport_valide_non" value="non">
            <label class="form-check-label" for="passeport_valide_non">Non</label>

        </div>

        <!-- Condition pour afficher la question 3 si la réponse est oui -->
        <div class="question-passeport">
            <div class="input-group input-group-outline mb-3 p-2">
                <label for="date_expiration_passeport" class="form-label">3- Si oui, quelle est la
                    date d'expiration
                    ?</label>
                <input type="text" name="date_expiration_passeport"
                    id="date_expiration_passeport" class="form-control">
            </div>
        </div>

    </div>

    <!-- Question 4 - Avez-vous un passeport valide ? -->
    <div class="mb-3">
        <label class="form-label">4- Avez-vous eut des problèmes avec la justice ?</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="casier_judiciaire"
                id="casier_judiciaire_oui" value="oui">
            <label class="form-check-label" for="casier_judiciaire_oui">Oui</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="casier_judiciaire"
                id="casier_judiciaire_non" value="non">
            <label class="form-check-label" for="casier_judiciaire_non">Non</label>
        </div>
    </div>

    <!-- Question 5 - Avez-vous un des soucis de santé ? -->
    <div class="mb-3">
        <label class="form-label">5- Avez-vous un des soucis de santé ?</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="soucis_sante"
                id="soucis_sante_oui" value="oui">
            <label class="form-check-label" for="soucis_sante_oui">Oui</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="soucis_sante"
                id="soucis_sante_non" value="non">
            <label class="form-check-label" for="soucis_sante_non">Non</label>
        </div>
    </div>

    <!-- Question 6 - 7 Avez-vous des enfants ? -->
    <div class="mb-3">
        <label class="form-label">6- Avez-vous des enfants ?</label>

        <div class="form-check">
            <!-- Option "Oui" -->
            <input class="form-check-input" type="radio" name="enfants" id="enfants_oui"
                value="oui">
            <label class="form-check-label" for="enfants_oui">Oui</label>

        </div>
        <!-- Option "Non" -->
        <div class="form-check">
            <input class="form-check-input" type="radio" name="enfants" id="enfants_non"
                value="non">
            <label class="form-check-label" for="enfants_non">Non</label>

        </div>
        <!-- Condition pour afficher la question 7 si la réponse est oui -->
        <div class="question-enfants">
            <div class="input-group input-group-outline mb-3 p-2">
                <label for="age_enfants" class="form-label">7- Si oui, quel est l'âge de vos
                    enfants ?</label>
                <input type="text" name="age_enfants" id="age_enfants" class="form-control">
            </div>
        </div>
    </div>

    <!-- Question 8 -->
    <div class="input-group input-group-outline mb-3 p-2">
        <label for="profession_domaine_travail" class="form-label">8- Quel est votre
            profession/domaine de travail
            ?</label>
        <input type="text" name="profession_domaine_travail" id="profession_domaine_travail"
            class="form-control">
    </div>

    <!-- Question 9 -->
    <div class="input-group input-group-outline mb-3 p-2">
        <label for="temps_travail_actuel" class="form-label">9- Depuis combien de temps ?</label>
        <input type="text" name="temps_travail_actuel" id="temps_travail_actuel"
            class="form-control">
    </div>

    <!-- Question 10 -->
    <div class="mb-3">
        <label class="form-label">10- Avez-vous une attestation de travail, bulletin de salaire et
            tous les autres
            documents relatifs à votre emploi ?</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="documents_emploi"
                id="documents_emploi_oui" value="oui">
            <label class="form-check-label" for="documents_emploi_oui">Oui</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="documents_emploi"
                id="documents_emploi_non" value="non">
            <label class="form-check-label" for="documents_emploi_non">Non</label>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-check-label" for="procedure_immigration">11-Avez-vous déjà entamé une
            procédure
            d'immigration au Canada ?</label>

        <!-- Option "Oui" -->
        <div class="form-check">
            <input class="form-check-input" type="radio" name="procedure_immigration"
                id="procedure_immigration_oui" value="oui">
            <label class="form-check-label" for="procedure_immigration_oui">Oui</label>

        </div>
        <!-- Questions supplémentaires (à afficher conditionnellement) -->
        <div class="questions-procedure_immigration" style="display: none;">
            <div class="input-group input-group-outline mb-3 p-2">
                <label for="questions-procedure_immigration1" class="form-label">12- Depuis quand
                    ?</label>
                <input type="text" name="questions-procedure-immigration1"
                    id="questions-procedure_immigration1" class="form-control">
            </div>
            <div class="input-group input-group-outline mb-3 p-2">
                <label for="questions-procedure_immigration2" class="form-label">13- Quel
                    programme ? et quelle a été
                    la décision ?</label>
                <input type="text" name="questions-procedure-immigration2"
                    id="questions-procedure_immigration2" class="form-control">
            </div>
        </div>
        <!-- Option "Non" -->
        <div class="form-check">
            <input class="form-check-input" type="radio" name="procedure_immigration"
                id="procedure_immigration_non" value="non">
            <label class="form-check-label" for="procedure_immigration_non">Non</label>

        </div>

    </div>

    <!-- Question 14 - Avez-vous un diplôme d'études (secondaire, professionnel, universitaire) ? -->
    <div class="mb-3">
        <label class="form-label">14- Avez-vous un diplôme d'études (secondaire, professionnel, universitaire) ?</label>
    
        <div class="form-check">
            <!-- Option "Oui" -->
            <input class="form-check-input" type="radio" name="diplome_etudes" id="diplome_etudes_oui" value="oui">
            <label class="form-check-label" for="diplome_etudes_oui">Oui</label>
    
            <!-- Question supplémentaire -->
            <div class="input-group input-group-outline mb-3 p question-diplome-etudes" style="display: none;">
                <label for="annee_obtention_diplome" class="form-label">Si oui, quelle est l'année d'obtention du diplôme ?</label>
                <input type="text" name="annee_obtention_diplome" id="annee_obtention_diplome" class="form-control">
            </div>
        </div>
    
        <div class="form-check">
            <!-- Option "Non" -->
            <input class="form-check-input" type="radio" name="diplome_etudes" id="diplome_etudes_non" value="non">
            <label class="form-check-label" for="diplome_etudes_non">Non</label>
        </div>
    </div>


    <!-- Question 15 - Avez-vous un membre de votre famille déjà au Canada ? -->
    <div class="mb-3">
        <label class="form-label">15- Avez-vous un membre de votre famille déjà au Canada ?</label>

        <div class="form-check">
            <!-- Option "Oui" -->
            <input class="form-check-input" type="radio" name="membre_famille_canada"
                id="membre_famille_canada_oui" value="oui">
            <label class="form-check-label" for="membre_famille_canada_oui">Oui</label>
        </div>

        <div class="form-check">
            <!-- Option "Non" -->
            <input class="form-check-input" type="radio" name="membre_famille_canada"
                id="membre_famille_canada_non" value="non">
            <label class="form-check-label" for="membre_famille_canada_non">Non</label>
        </div>
    </div>

    <!-- Question 16 -->
    <div class="mb-3">
        <label class="form-label">16- Comptez-vous immigrer seul(e) ou en famille ?</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="immigrer_seul_ou_famille"
                id="immigrer_seul" value="seul">
            <label class="form-check-label" for="immigrer_seul">Seul(e)</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="immigrer_seul_ou_famille"
                id="immigrer_en_famille" value="famille">
            <label class="form-check-label" for="immigrer_en_famille">En famille</label>
        </div>
    </div>

    <!-- Question 17 -->
    <div class="mb-3">
        <label class="form-check-label">17- Parlez-vous d'autres langues à part le français
            ?</label>
        <!-- Option "Oui" -->
        <div class="form-check">
            <input class="form-check-input" type="radio" name="langues_parlees"
                value="oui">
            <label class="form-check-label" for="langues_parlees_oui">Oui</label>
        </div>
        <!-- Option "Non" -->

        <div class="form-check">
            <input class="form-check-input" type="radio" name="langues_parlees"
                value="non">
            <label class="form-check-label" for="langues_parlees_non">Non</label>

        </div>
    </div>

    <!-- Question 18 -->
    <div class="mb-3">
        <label class="form-check-label">18- Avez-vous fait un test de connaissances linguistiques
            ?</label>
        <!-- Option "Oui" -->

        <div class="form-check">
            <input class="form-check-input" type="radio"
                name="test_connaissances_linguistiques" value="oui">
            <label class="form-check-label" for="test_connaissances_linguistiques_oui">Oui</label>

        </div>
        <!-- Option "Non" -->
        <div class="form-check">
            <input class="form-check-input" type="radio"
                name="test_connaissances_linguistiques" value="non">
            <label class="form-check-label" for="test_connaissances_linguistiques_non">Non</label>

        </div>
    </div>

    <h4>CONJOINT / EPOUX / EPOUSE</h4>

    <!-- Question 1 -->
    <div class="input-group input-group-outline mb-3 p-2">
        <label for="niveau_scolarite_conjoint" class="form-label">1- Quel est son niveau de
            scolarité ?</label>
        <input type="text" name="niveau_scolarite_conjoint" id="niveau_scolarite_conjoint"
            class="form-control">
    </div>

    <!-- Question 2 -->
    <div class="input-group input-group-outline mb-3 p-2">
        <label for="domaine_formation_conjoint" class="form-label">2- Quel est votre domaine de
            formation ?</label>
        <input type="text" name="domaine_formation_conjoint" id="domaine_formation_conjoint"
            class="form-control">
    </div>

    <!-- Question 3 -->
    <div class="input-group input-group-outline mb-3 p-2">
        <label for="age_conjoint" class="form-label">3- Quel est votre âge ?</label>
        <input type="text" name="age_conjoint" id="age_conjoint" class="form-control">
    </div>

    <!-- CONNAISSANCES LINGUISTIQUES -->
    <h4>CONNAISSANCES LINGUISTIQUES</h4>

    <!-- Question 1 -->
    <div class="input-group input-group-outline mb-3 p-2">
        <label for="niveau_francais" class="form-label">1- Niveau en français</label>
        <input type="text" name="niveau_francais" id="niveau_francais" class="form-control">
    </div>

    <!-- Question 2 -->
    <div class="input-group input-group-outline mb-3 p-2">
        <label for="niveau_anglais" class="form-label">2- Niveau en anglais</label>
        <input type="text" name="niveau_anglais" id="niveau_anglais" class="form-control">
    </div>

    <!-- Question 3 -->
    <div class="input-group input-group-outline mb-3 p-2">
        <label for="age_enfants_linguistique" class="form-label">3- Quel est l'âge de vos enfants
            ?</label>
        <input type="text" name="age_enfants_linguistique" id="age_enfants_linguistique"
            class="form-control">
    </div>

    <!-- Question 4 -->
    <div class="input-group input-group-outline mb-3 p-2">
        <label for="niveau_scolarite_enfants" class="form-label">4- Quel est leur niveau de
            scolarité ?</label>
        <input type="text" name="niveau_scolarite_enfants" id="niveau_scolarite_enfants"
            class="form-control">
    </div>

    <div class="form-group">
        <label for="cv" class="form-label">Télécharger votre CV (PDF uniquement) :</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="cv" name="cv" accept=".pdf">
            <label class="custom-file-label" for="cv">Choisir un fichier</label>
        </div>
    </div>

    <div class="form-group input-group input-group-outline mb-3 p-2">
        <label for="remarques" class="form-label">Remarques de l'agent :</label>
        <textarea class="form-control" id="remarques" name="remarques" rows="4" oninput="handleTextareaInput(this)"></textarea>
    </div>
    
    <script>
        function handleTextareaInput(textarea) {
            const label = document.querySelector('label[for="remarques"]');
            if (textarea.value.trim() !== '') {
                label.classList.add('d-none');
            } else {
                label.classList.remove('d-none');
            }
        }
    </script>
    
    
</div>



</div>


<script>
   $(document).ready(function() {
    // Cacher la question de la date d'expiration au chargement de la page
    $('.question-passeport').hide();

    $('.anne_obtention_diplome').hide();

    // Cacher la question sur la procédure d'immigration au Canada au chargement de la page
    $('.questions-procedure_immigration').hide();

    // Cacher la question sur l'âge des enfants au chargement de la page
    $('.question-enfants').hide();

    // Écouter le changement des boutons radio pour le passeport
    $('input[name="passeport_valide"]').change(function() {
        // Afficher ou masquer la question de la date d'expiration en fonction de la réponse
        if ($(this).val() === 'oui') {
            $('.question-passeport').show();
        } else {
            $('.question-passeport').hide();
        }
    });

    // Écouter le changement des boutons radio pour la procédure d'immigration
    $('input[name="procedure_immigration"]').change(function() {
        // Afficher ou masquer les questions supplémentaires en fonction de la réponse
        if ($(this).val() === 'oui') {
            $('.questions-procedure_immigration').show();
        } else {
            $('.questions-procedure_immigration').hide();
        }
    });

    // Écouter le changement de la réponse à la question sur la présence d'enfants
    $('input[name="enfants"]').change(function() {
        // Afficher ou masquer la question sur l'âge en fonction de la réponse
        if ($(this).val() === 'oui') {
            $('.question-enfants').show();
        } else {
            $('.question-enfants').hide();
        }
    });

    $('input[name="diplome_etudes"]').change(function() {
    // Récupérer la valeur sélectionnée
    var valeurSelectionnee = $(this).val();

    // Afficher ou masquer la question sur l'année d'obtention en fonction de la réponse
    if (valeurSelectionnee === 'oui') {
        $('.question-diplome-etudes').show();
    } else {
        $('.question-diplome-etudes').hide();
    }
});
});

</script>
