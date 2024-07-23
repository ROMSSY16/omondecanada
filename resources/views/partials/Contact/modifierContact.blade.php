<div class="modal z-index-1 fade" id="modifierContactModal{{ $candidat->id }}" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier Contact</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('modifierContact', $candidat->id) }}" method="POST" class="text-start"
                    id="modifierContactForm{{ $candidat->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Champs Nom et Prénoms sur la même ligne -->
                    <div class="d-flex">
                        <div class="input-group input-group-outline w-30 my-3 p-2">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" name="nom" id="nom" class="form-control"
                                value="{{ $candidat->nom }}" required>
                        </div>

                        <div class="input-group input-group-outline w-70 my-3 p-2">
                            <label for="prenoms" class="form-label">Prénoms</label>
                            <input type="text" name="prenoms" id="prenoms" class="form-control"
                                value="{{ $candidat->prenom }}" required>
                        </div>
                    </div>

                    <div class="d-flex">
                        <!-- Champ Pays -->
                        <div class="input-group input-group-outline w-40 mb-3 p-2">
                            <label for="pays" class="form-label">Pays</label>
                            <input type="text" name="pays" id="pays" class="form-control"
                                value="{{ $candidat->pays }}" required>
                        </div>

                        <!-- Champ Ville -->
                        <div class="input-group input-group-outline w-60 mb-3 p-2">
                            <label for="ville" class="form-label">Ville</label>
                            <input type="text" name="ville" id="ville" class="form-control"
                                value="{{ $candidat->ville }}" required>
                        </div>
                    </div>

                    <!-- Champ Téléphone -->
                    <div class="d-flex">
                        <div class="input-group input-group-outline mb-3 p-2">
                            <label for="numero_telephone" class="form-label">Téléphone</label>
                            <input type="tel" name="numero_telephone" id="numero_telephone" class="form-control"
                                value="{{ $candidat->numero_telephone }}" required>
                        </div>

                        <!-- Champ Email -->
                        <div class="input-group input-group-outline mb-3 p-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ $candidat->email }}" required>
                        </div>
                    </div>

                    <div class="d-flex">
                        <!-- Champ Profession -->
                        <div class="input-group input-group-outline w-50 mb-3 p-2">
                            <label for="profession" class="form-label">Profession</label>
                            <input type="text" name="profession" id="profession" class="form-control"
                                value="{{ $candidat->profession }}" required>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input consultation-payee" type="checkbox" name="consultation_payee"
                                id="consultation-payee-{{ $candidat->id }}"
                                {{ $candidat->consultation_payee ? 'checked' : '' }}>
                            <label class="form-check-label" for="consultation-payee-{{ $candidat->id }}">Consultation
                                payée</label>
                        </div>

                    </div>

                    <div class="questionnaire-form" id="questionnaire-form-{{ $candidat->id }}" style="display: none;">


                        <h4>Questionnaire supplémentaire</h4>


                        <!-- Type de visa -->
                        <div class="mb-3">
                            <label class="form-label">Quel type de visa desirez-vous ?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type_visa" id="etudiant"
                                    value="etudiant"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->type_visa === 'etudiant' ? 'checked' : '' }}>
                          
                                    
                                <label class="form-check-label" for="etudiant">Étudiant</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type_visa" id="travailleur"
                                    value="travailleur"   {{ $candidat->ficheConsultation && $candidat->ficheConsultation->type_visa === 'travailleur' ? 'checked' : '' }}>
                                    
                                <label class="form-check-label" for="travailleur">Travailleur</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type_visa" id="visiteur"
                                    value="visiteur"   {{ $candidat->ficheConsultation && $candidat->ficheConsultation->type_visa === 'visiteur' ? 'checked' : '' }}>
                                    
                                <label class="form-check-label" for="visiteur">Visiteur</label>
                            </div>
                        </div>
                        <div class="input-group input-group-outline mb-3 p-2">
                            <label for="date_naissance_conjoint" class="form-label">2- Quelle est votre date de naissance ?</label>
                            <input type="date" name="date_naissance" id="date_naissance" class="form-control"
                                   value="{{ ($candidat && $candidat->date_naissance) ? $candidat->date_naissance : '' }}">
                        </div>
                        


                        <!-- Question 1 -->
                        <div class="mb-3">
                            <label class="form-label">1- Statut matrimonial</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="statut_matrimonial"
                                    id="celibataire" value="Celibataire"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse1 === 'Celibataire' ? 'checked' : '' }}>
                                <label class="form-check-label" for="celibataire">Célibataire</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="statut_matrimonial"
                                    id="marie" value="Marie"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse1 === 'Marie' ? 'checked' : '' }}>
                                <label class="form-check-label" for="marie">Marié</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="statut_matrimonial"
                                    id="fiance" value="Fiance"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse1 === 'Fiance' ? 'checked' : '' }}>
                                <label class="form-check-label" for="fiance">Fiancé(e)</label>
                            </div>
                        </div>


                        <!-- Question 2  et 3n- Avez-vous un passeport valide ? -->
                        <div class="mb-3">
                            <label class="form-label">2- Avez-vous un passeport valide ?</label>
                            <div class="form-check">
                                <!-- Option "Oui" -->
                                <input class="form-check-input" type="radio" name="passeport_valide"
                                    id="passeport_valide_oui" value="oui"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse2 === 'oui' ? 'checked' : '' }}>
                                <label class="form-check-label" for="passeport_valide_oui">Oui</label>
                            </div>

                            <div class="form-check">
                                <!-- Option "Non" -->
                                <input class="form-check-input" type="radio" name="passeport_valide"
                                    id="passeport_valide_non" value="non"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse2 === 'non' ? 'checked' : '' }}>
                                <label class="form-check-label" for="passeport_valide_non">Non</label>
                            </div>

                            <!-- Condition pour afficher la question 3 si la réponse est oui -->
                            <div class="question-passeport">
                                <div class="input-group input-group-outline mb-3 p-2">
                                    <label for="date_expiration_passeport" class="form-label">3- Si oui, quelle est la
                                        date d'expiration ?</label>
                                    <input type="text" name="date_expiration_passeport"
                                        id="date_expiration_passeport" class="form-control"
                                        value="{{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse2 === 'oui' ? $candidat->ficheConsultation->reponse3 ?? null : null }}">
                                </div>
                            </div>
                        </div>


                        <!-- Question 4 - Avez-vous un passeport valide ? -->
                        <div class="mb-3">
                            <label class="form-label">4- Avez-vous un casier judiciaire ?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="casier_judiciaire"
                                    id="casier_judiciaire_oui" value="oui"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse4 === 'oui' ? 'checked' : '' }}>
                                <label class="form-check-label" for="casier_judiciaire_oui">Oui</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="casier_judiciaire"
                                    id="casier_judiciaire_non" value="non"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse4 === 'non' ? 'checked' : '' }}>
                                <label class="form-check-label" for="casier_judiciaire_non">Non</label>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">5- Avez-vous un des soucis de santé ?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="soucis_sante"
                                    id="soucis_sante_oui" value="oui"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse5 === 'oui' ? 'checked' : '' }}>
                                <label class="form-check-label" for="soucis_sante_oui">Oui</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="soucis_sante"
                                    id="soucis_sante_non" value="non"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse5 === 'non' ? 'checked' : '' }}>
                                <label class="form-check-label" for="soucis_sante_non">Non</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">6- Avez-vous des enfants ?</label>
                            <div class="form-check">
                                <!-- Option "Oui" -->
                                <input class="form-check-input" type="radio" name="enfants" id="enfants_oui"
                                    value="oui"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse6 === 'oui' ? 'checked' : '' }}>
                                <label class="form-check-label" for="enfants_oui">Oui</label>
                            </div>
                            <!-- Option "Non" -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="enfants" id="enfants_non"
                                    value="non"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse6 === 'non' ? 'checked' : '' }}>
                                <label class="form-check-label" for="enfants_non">Non</label>
                            </div>
                            <!-- Condition pour afficher la question 7 si la réponse est oui -->
                            <div class="question-enfants"
                                {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse6 === 'oui' ? '' : 'style=display:none;' }}>
                                <div class="input-group input-group-outline mb-3 p-2">
                                    <label for="age_enfants" class="form-label">7- Si oui, quel est l'âge de vos
                                        enfants ?</label>
                                    <input type="text" name="age_enfants" id="age_enfants" class="form-control"
                                        value="{{ $candidat->ficheConsultation ? $candidat->ficheConsultation->reponse7 ?? null : null }}">
                                </div>
                            </div>
                        </div>


                        <!-- Question 8 -->
                        <div class="input-group input-group-outline mb-3 p-2">
                            <label for="profession_domaine_travail" class="form-label">8- Quel est votre
                                profession/domaine de travail ?</label>
                            <input type="text" name="profession_domaine_travail" id="profession_domaine_travail"
                                class="form-control"
                                value="{{ $candidat->ficheConsultation ? $candidat->ficheConsultation->reponse8 ?? null : null }}">
                        </div>

                        <!-- Question 9 -->
                        <div class="input-group input-group-outline mb-3 p-2">
                            <label for="temps_travail_actuel" class="form-label">9- Depuis combien de temps ?</label>
                            <input type="text" name="temps_travail_actuel" id="temps_travail_actuel"
                                class="form-control"
                                value="{{ $candidat->ficheConsultation ? $candidat->ficheConsultation->reponse9 ?? null : null }}">
                        </div>


                        <!-- Question 10 -->
                        <!-- Question 10 -->
                        <div class="mb-3">
                            <label class="form-label">10- Avez-vous une attestation de travail, bulletin de salaire et
                                tous les autres documents relatifs à votre emploi ?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="documents_emploi"
                                    id="documents_emploi_oui" value="oui"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse10 === 'oui' ? 'checked' : '' }}>
                                <label class="form-check-label" for="documents_emploi_oui">Oui</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="documents_emploi"
                                    id="documents_emploi_non" value="non"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse10 === 'non' ? 'checked' : '' }}>
                                <label class="form-check-label" for="documents_emploi_non">Non</label>
                            </div>
                        </div>

                        <!-- Question 11 -->
                        <div class="mb-3">
                            <label class="form-check-label" for="procedure_immigration">11-Avez-vous déjà entamé une
                                procédure d'immigration au Canada ?</label>
                            <!-- Option "Oui" -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="procedure_immigration"
                                    id="procedure_immigration_oui" value="oui"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse11 === 'oui' ? 'checked' : '' }}>
                                <label class="form-check-label" for="procedure_immigration_oui">Oui</label>
                            </div>
                            <!-- Questions supplémentaires (à afficher conditionnellement) -->
                            <div class="questions-procedure_immigration"
                                style="{{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse11 === 'oui' ? '' : 'display:none;' }}">
                                <div class="input-group input-group-outline mb-3 p-2">
                                    <label for="questions-procedure_immigration1" class="form-label">12- Depuis quand
                                        ?</label>
                                    <input type="text" name="questions-procedure-immigration1"
                                        id="questions-procedure_immigration1" class="form-control"
                                        value="{{ $candidat->ficheConsultation ? $candidat->ficheConsultation->reponse12 ?? null : null }}">
                                </div>
                                <div class="input-group input-group-outline mb-3 p-2">
                                    <label for="questions-procedure_immigration2" class="form-label">13- Quel
                                        programme ? et quelle a été la décision ?</label>
                                    <input type="text" name="questions-procedure-immigration2"
                                        id="questions-procedure_immigration2" class="form-control"
                                        value="{{ $candidat->ficheConsultation ? $candidat->ficheConsultation->reponse13 ?? null : null }}">
                                </div>
                            </div>
                            <!-- Option "Non" -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="procedure_immigration"
                                    id="procedure_immigration_non" value="non"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse11 === 'non' ? 'checked' : '' }}>
                                <label class="form-check-label" for="procedure_immigration_non">Non</label>
                            </div>
                        </div>


                        <!-- Question 14 -->
                        <div class="mb-3">
                            <label class="form-label">14- Avez-vous un diplôme d'études (secondaire, professionnel,
                                universitaire) ?</label>
                            <div class="form-check">
                                <!-- Option "Oui" -->
                                <input class="form-check-input" type="radio" name="diplome_etudes"
                                    id="diplome_etudes_oui" value="oui"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse14 === 'oui' ? 'checked' : '' }}>
                                <label class="form-check-label" for="diplome_etudes_oui">Oui</label>
                                <!-- Condition to show the question on the year of obtaining the diploma if the answer is "Yes" -->
                                <div class="question-diplome-etudes"
                                    style="{{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse14 === 'oui' ? '' : 'display:none;' }}">
                                    <div class="input-group input-group-outline mb-3 p">
                                        <label for="annee_obtention_diplome" class="form-label">Si oui, quelle est
                                            l'année d'obtention du diplôme ?</label>
                                        <input type="text" name="annee_obtention_diplome"
                                            id="annee_obtention_diplome" class="form-control"
                                            value="{{ $candidat->ficheConsultation ? $candidat->ficheConsultation->reponse15 ?? null : null }}">
                                    </div>
                                </div>
                            </div>
                            <!-- Option "Non" -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="diplome_etudes"
                                    id="diplome_etudes_non" value="non"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse14 === 'non' ? 'checked' : '' }}>
                                <label class="form-check-label" for="diplome_etudes_non">Non</label>
                            </div>
                        </div>

                        <!-- Question 15 -->
                        <div class="mb-3">
                            <label class="form-label">15- Avez-vous un membre de votre famille déjà au Canada ?</label>
                            <div class="form-check">
                                <!-- Option "Oui" -->
                                <input class="form-check-input" type="radio" name="membre_famille_canada"
                                    id="membre_famille_canada_oui" value="oui"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse16 === 'oui' ? 'checked' : '' }}>
                                <label class="form-check-label" for="membre_famille_canada_oui">Oui</label>
                            </div>
                            <!-- Option "Non" -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="membre_famille_canada"
                                    id="membre_famille_canada_non" value="non"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse16 === 'non' ? 'checked' : '' }}>
                                <label class="form-check-label" for="membre_famille_canada_non">Non</label>
                            </div>
                        </div>

                        <!-- Question 16 -->
                        <div class="mb-3">
                            <label class="form-label">16- Comptez-vous immigrer seul(e) ou en famille ?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="immigrer_seul_ou_famille"
                                    id="immigrer_seul" value="seul"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse17 === 'seul' ? 'checked' : '' }}>
                                <label class="form-check-label" for="immigrer_seul">Seul(e)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="immigrer_seul_ou_famille"
                                    id="immigrer_en_famille" value="famille"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse17 === 'famille' ? 'checked' : '' }}>
                                <label class="form-check-label" for="immigrer_en_famille">En famille</label>
                            </div>
                        </div>

                        <!-- Question 17 -->
                        <div class="mb-3">
                            <label class="form-check-label">17- Parlez-vous d'autres langues à part le français
                                ?</label>
                            <!-- Option "Oui" -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="langues_parlees" value="oui"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse18 === 'oui' ? 'checked' : '' }}>
                                <label class="form-check-label" for="langues_parlees_oui">Oui</label>
                            </div>
                            <!-- Option "Non" -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="langues_parlees" value="non"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse18 === 'non' ? 'checked' : '' }}>
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
                                    name="test_connaissances_linguistiques" value="oui"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse19 === 'oui' ? 'checked' : '' }}>
                                <label class="form-check-label" for="test_connaissances_linguistiques_oui">Oui</label>
                            </div>
                            <!-- Option "Non" -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio"
                                    name="test_connaissances_linguistiques" value="non"
                                    {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse19 === 'non' ? 'checked' : '' }}>
                                <label class="form-check-label" for="test_connaissances_linguistiques_non">Non</label>
                            </div>
                        </div>

                        <h4>CONJOINT / EPOUX / EPOUSE</h4>

                        <!-- Question 19 -->
                        <div class="input-group input-group-outline mb-3 p-2">
                            <label for="niveau_scolarite_conjoint" class="form-label">1- Quel est son niveau de
                                scolarité ?</label>
                            <input type="text" name="niveau_scolarite_conjoint" id="niveau_scolarite_conjoint"
                                class="form-control">
                        </div>

                        <!-- Question 20 -->
                        <div class="input-group input-group-outline mb-3 p-2">
                            <label for="domaine_formation_conjoint" class="form-label">2- Quel est votre domaine de
                                formation ?</label>
                            <input type="text" name="domaine_formation_conjoint" id="domaine_formation_conjoint"
                                class="form-control">
                        </div>

                        <!-- Question 21 -->
                        <div class="input-group input-group-outline mb-3 p-2">
                            <label for="age_conjoint" class="form-label">3- Quel est votre âge ?</label>
                            <input type="text" name="age_conjoint" id="age_conjoint" class="form-control">
                        </div>

                        <!-- CONNAISSANCES LINGUISTIQUES -->
                        <h4>CONNAISSANCES LINGUISTIQUES</h4>

                        <!-- Question 22 -->
                        <div class="input-group input-group-outline mb-3 p-2">
                            <label for="niveau_francais" class="form-label">1- Niveau en français</label>
                            <input type="text" name="niveau_francais" id="niveau_francais" class="form-control"
                                value="{{ $candidat->ficheConsultation->reponse22 ?? '' }}">
                        </div>

                        <!-- Question 23 -->
                        <div class="input-group input-group-outline mb-3 p-2">
                            <label for="niveau_anglais" class="form-label">2- Niveau en anglais</label>
                            <input type="text" name="niveau_anglais" id="niveau_anglais" class="form-control"
                                value="{{ $candidat->ficheConsultation->reponse23 ?? '' }}">
                        </div>

                        <!-- Question 24 -->
                        <div class="input-group input-group-outline mb-3 p-2">
                            <label for="age_enfants_linguistique" class="form-label">3- Quel est l'âge de vos enfants
                                ?</label>
                            <input type="text" name="age_enfants_linguistique" id="age_enfants_linguistique"
                                class="form-control" value="{{ $candidat->ficheConsultation->reponse24 ?? '' }}">
                        </div>

                        <!-- Question 25 -->
                        <div class="input-group input-group-outline mb-3 p-2">
                            <label for="niveau_scolarite_enfants" class="form-label">4- Quel est leur niveau de
                                scolarité ?</label>
                            <input type="text" name="niveau_scolarite_enfants" id="niveau_scolarite_enfants"
                                class="form-control" value="{{ $candidat->ficheConsultation->reponse25 ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="cv" class="form-label">Fichier CV actuel :</label>
                            @if ($candidat->ficheConsultation && $candidat->ficheConsultation->lien_cv)
                                <p>
                                    <a href="{{ asset('storage/' . $candidat->ficheConsultation->lien_cv) }}"
                                        target="_blank">
                                        Voir le CV
                                    </a>
                                </p>
                            @else
                                <p>Aucun fichier CV téléchargé</p>
                            @endif
                        </div>


                        <!-- File input for updating CV -->
                        <div class="form-group">
                            <label for="cv" class="form-label">Télécharger un nouveau CV (PDF uniquement)
                                :</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="cv" name="cv"
                                    accept=".pdf">
                                <label class="custom-file-label" for="cv">Choisir un fichier</label>
                            </div>
                        </div>


                        {{-- Remarque agent --}}
                        <div class="form-group input-group input-group-outline mb-3 p-2">
                            <label for="remarques" class="form-label">Remarques de l'agent :</label>
                            <textarea class="form-control" id="remarques" name="remarques" rows="4" oninput="handleTextareaInput(this)">
        {{ $candidat->remarque_agent ?? '' }}</textarea>
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


                    <div class="text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary"
                            onclick="$('#modifierContactForm{{ $candidat->id }}').submit()">Enregistrer les
                            modifications</button>
                    </div>

            </div>

            </form>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        // Cacher le questionnaire supplémentaire au chargement de la page
        $('.questionnaire-form').hide();

        // Écouter le changement de la checkbox consultation_payee
        $('.consultation-payee').change(function() {
            // Récupérer l'ID unique du candidat
            var candidatId = $(this).attr('id').split('-')[2];

            // Construire l'ID unique de la section du questionnaire
            var questionnaireId = '#questionnaire-form-' + candidatId;

            // Afficher ou masquer le questionnaire supplémentaire en fonction de l'état de la checkbox
            if (this.checked) {
                $(questionnaireId).show();
            } else {
                $(questionnaireId).hide();
            }
        });
    });
</script>
