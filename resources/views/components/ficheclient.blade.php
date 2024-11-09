<div class="modal z-index-1 fade" id="ModifierFicheModal{{ $candidat->id }}" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header text-ceter">
                <h4 class="modal-title " id="exampleModalLabel">Créer Fiche de Consultation</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('consultation.modifier_fiche_client', $candidat->id) }}" method="POST"
                    class="text-start ficheCons" id="modifierContactForm{{ $candidat->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Champs Nom et Prénoms sur la même ligne -->
                    <input type="hidden" name="idCandidat" value="{{$candidat->id}}">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" name="nom" id="nom" class="form-control"
                                value="{{ $candidat->nom }}" required>
                        </div>

                        <div class="col-md-6 mb-3"> <label for="prenoms" class="form-label">Prénoms</label>
                            <input type="text" name="prenoms" id="prenoms" class="form-control"
                                value="{{ $candidat->prenom }}" required>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="pays" class="form-label">Pays</label>
                            <select name="pays" id="pays" class="form-control" required>
                                @foreach (App\Models\Succursale::all() as $succursale)
                                    <option value="{{ $succursale->label }}"
                                        {{ $candidat->pays == $succursale->label ? 'selected' : '' }}>
                                        {{ $succursale->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Champ Ville -->
                        <div class="col-md-6 mb-3"> <label for="ville" class="form-label">Ville</label>
                            <input type="text" name="ville" id="ville" class="form-control"
                                value="{{ $candidat->ville }}" required>
                        </div>
                    </div>

                    <!-- Champ Téléphone -->
                    <div class="row">
                        <div class="col-md-4 mb-3"> <label for="numero_telephone" class="form-label">Téléphone</label>
                            <input type="tel" name="numero_telephone" id="numero_telephone" class="form-control"
                                value="{{ $candidat->numero_telephone }}" required>
                        </div>

                        <!-- Champ Email -->
                        <div class="col-md-8 mb-3"> <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ $candidat->email }}" required>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <!-- Champ Profession -->
                        <div class="col-8">
                            <label for="profession" class="form-label">Profession</label>
                            <input type="text" name="profession" id="profession" class="form-control"
                                value="{{ $candidat->profession }}" required>
                        </div>

                        <div class="form-check col-2 d-flex flex-column justify-content-center align-items-center">
                            <label class="form-check-label mb-0"
                                for="consultation-payee-{{ $candidat->id }}">Consultation payée</label>
                            <input class="form-check-input consultation-payee" type="checkbox" name="consultation_payee"
                                id="consultation-payee-{{ $candidat->id }}"
                                {{ $candidat->consultation_payee ? 'checked' : '' }}>
                        </div>
                        @php
                            $entree = \App\Models\Entree::where('id_candidat', $candidat->id)->first();
                        @endphp
                        @if ($entree)
                            <div class="mb-3 p-2">
                                <label for="modePaiement" class="form-label">Mode de paiement :</label>
                                <input class="form-control" type="text" value="{{ $entree->modePaiement->label }}" disabled>
                            </div>
                        @else
                            <div class="mb-3 p-2">
                                <label for="modePaiement" class="form-label">Mode de paiement :</label>
                                <select name="modePaiement" id="modePaiement" class="form-control" required>
                                    <option value="" disabled {{ old('modePaiement') ? '' : 'selected' }}>Choisissez un moyen de paiement</option>
                                    <!-- Boucle PHP pour récupérer et afficher les modes de paiement -->
                                    @foreach(\App\Models\ModePaiement::get() as $item)
                                        <option value="{{ $item->id }}" {{ old('modePaiement') == $item->id ? 'selected' : '' }}>
                                            {{ $item->label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif


                    </div>

                    <div class="row mb-3">
                        <div class="btn btn-dark afficherQuestionnaire{{$candidat->id}}">
                            Modifier ou remplir la fiche de consultation
                        </div>
                    </div>

                    <div class="questionnaire-form{{$candidat->id}}" style="display: none;">


                        <h3 class="mb-6 text-center">Questionnaire supplémentaire</h3>


                        <!-- Type de visa -->
                        <div class="mb-3 d-flex justify-content-between">
                            <label class="form-label text-xl text-dark">
                                <h5>
                                    1- Quel type de visa désirez-vous ?</h5>
                            </label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type_visa" id="etudiant"
                                        value="etudiant"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->type_visa === 'etudiant' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="etudiant">Étudiant</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type_visa" id="travailleur"
                                        value="travailleur"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->type_visa === 'travailleur' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="travailleur">Travailleur</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type_visa" id="visiteur"
                                        value="visiteur"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->type_visa === 'visiteur' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="visiteur">Visiteur</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type_visa" id="Permanent"
                                        value="Permanent"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->type_visa === 'Permanent' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="Permanent">Permanent</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type_visa" id="Famille"
                                        value="Famille"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->type_visa === 'Famille' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="Famille">Famille</label>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-between mb-3 p-2 align-items-center">
                            <label for="date_naissance_conjoint text-dark" class="form-label col-6">
                                <h5>2- Quelle est votre date de naissance ?</h5>
                            </label>
                            <div class="col-5">
                                <input type="date" name="date_naissance" id="date_naissance" class="form-control"
                                    value="{{ $candidat && $candidat->date_naissance ? $candidat->date_naissance : '' }}">
                            </div>
                        </div>

                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <label class="form-label text-dark">
                                <h5>
                                    3- Statut matrimonial
                                </h5>
                            </label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="statut_matrimonial"
                                        id="celibataire" value="Celibataire"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse1 === 'Celibataire' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="celibataire">Célibataire</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="statut_matrimonial"
                                        id="marie" value="Marie"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse1 === 'Marie' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="marie">Marié</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="statut_matrimonial"
                                        id="fiance" value="Fiance"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse1 === 'Fiance' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fiance">Fiancé(e)</label>
                                </div>
                            </div>
                        </div>



                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <label class="form-label text-dark">
                                <h5>4- Avez-vous un passeport valide ?</h5>
                            </label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="passeport_valide"
                                        id="passeport_valide_oui" value="oui"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse2 === 'oui' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="passeport_valide_oui">Oui</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="passeport_valide"
                                        id="passeport_valide_non" value="non"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse2 === 'non' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="passeport_valide_non">Non</label>
                                </div>
                            </div>
                        </div>

                        <!-- Condition pour afficher la question 3 si la réponse est oui -->
                        <div class="mb-3 d-flex justify-content-between question-passeport">
                            <label for="date_expiration_passeport" class="form-label text-dark">
                                <h5>5- Si oui, quelle est la date d'expiration ?</h5>
                            </label>
                            <div>
                                <input type="text" name="date_expiration_passeport" id="date_expiration_passeport"
                                    class="form-control"
                                    value="{{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse2 === 'oui' ? $candidat->ficheConsultation->reponse3 ?? null : null }}">
                            </div>
                        </div>



                        <div class="mb-3 d-flex justify-content-between">
                            <label class="form-label text-dark">
                                <h5>6- Avez-vous un casier judiciaire ?</h5>
                            </label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="casier_judiciaire"
                                        id="casier_judiciaire_oui" value="oui"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse4 === 'oui' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="casier_judiciaire_oui">Oui</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="casier_judiciaire"
                                        id="casier_judiciaire_non" value="non"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse4 === 'non' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="casier_judiciaire_non">Non</label>
                                </div>
                            </div>
                        </div>

                        <!-- Question 5 - Avez-vous des soucis de santé ? -->
                        <div class="mb-3 d-flex justify-content-between">
                            <label class="form-label text-dark">
                                <h5>5- Avez-vous des soucis de santé ?</h5>
                            </label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="soucis_sante"
                                        id="soucis_sante_oui" value="oui"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse5 === 'oui' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="soucis_sante_oui">Oui</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="soucis_sante"
                                        id="soucis_sante_non" value="non"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse5 === 'non' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="soucis_sante_non">Non</label>
                                </div>
                            </div>
                        </div>


                        <!-- Question 6 - Avez-vous des enfants ? -->
                        <div class="mb-3 d-flex justify-content-between">
                            <label class="form-label text-dark">
                                <h5>6- Avez-vous des enfants ?</h5>
                            </label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="enfants" id="enfants_oui"
                                        value="oui"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse6 === 'oui' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="enfants_oui">Oui</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="enfants" id="enfants_non"
                                        value="non"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse6 === 'non' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="enfants_non">Non</label>
                                </div>
                            </div>
                        </div>

                        <div class="row question-enfants"
                            {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse6 === 'oui' ? '' : 'style=display:none;' }}>
                            <div class=" d-flex align-item-center justify-content-between mb-3">
                                <label for="age_enfants" class="form-label">
                                    <h5>
                                        7- Si oui, quel est l'âge de vos
                                        enfants ?
                                    </h5>
                                </label>
                                <div class="col-5">
                                    <input type="text" name="age_enfants" id="age_enfants" class="form-control"
                                        value="{{ $candidat->ficheConsultation ? $candidat->ficheConsultation->reponse7 ?? null : null }}">

                                </div>
                            </div>
                        </div>



                        <!-- Question 8 -->
                        <div class="mb-3 d-flex justify-content-between">
                            <label for="profession_domaine_travail" class="form-label text-dark">
                                <h5>8- Quel est votre profession/domaine de travail ?</h5>
                            </label>
                            <div>
                                <input type="text" name="profession_domaine_travail"
                                    id="profession_domaine_travail" class="form-control"
                                    value="{{ $candidat->ficheConsultation ? $candidat->ficheConsultation->reponse8 ?? null : null }}">
                            </div>
                        </div>

                        <!-- Question 9 -->
                        <div class="mb-3 d-flex justify-content-between">
                            <label for="temps_travail_actuel" class="form-label text-dark">
                                <h5>9- Depuis combien de temps ?</h5>
                            </label>
                            <div>
                                <input type="text" name="temps_travail_actuel" id="temps_travail_actuel"
                                    class="form-control"
                                    value="{{ $candidat->ficheConsultation ? $candidat->ficheConsultation->reponse9 ?? null : null }}">
                            </div>
                        </div>



                        <!-- Question 10 -->
                        <div class="mb-3 d-flex justify-content-between">
                            <label class="form-label text-xl text-dark">
                                <h5>10- Avez-vous des documents relatifs à votre emploi ?
                                </h5>
                            </label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="documents_emploi"
                                        id="documents_emploi_oui" value="oui"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse10 === 'oui' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="documents_emploi_oui">Oui</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="documents_emploi"
                                        id="documents_emploi_non" value="non"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse10 === 'non' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="documents_emploi_non">Non</label>
                                </div>
                            </div>
                        </div>




                        <!-- Question 11 -->
                        <div class="d-flex justify-content-between">
                            <label class="form-label text-xl text-dark">
                                <h5>11- Avez-vous déjà entamé une procédure pour le Canada ?</h5>
                            </label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="procedure_immigration"
                                        id="procedure_immigration_oui" value="oui"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse11 === 'oui' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="procedure_immigration_oui">Oui</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="procedure_immigration"
                                        id="procedure_immigration_non" value="non"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse11 === 'non' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="procedure_immigration_non">Non</label>
                                </div>
                            </div>

                        </div>
                        <!-- Questions supplémentaires (à afficher conditionnellement) -->
                        <div class="questions-procedure_immigration"
                            style="{{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse11 === 'oui' ? '' : 'display:none;' }}">
                            <div class="mb-3 d-flex justify-content-between">
                                <label class="form-label text-xl text-dark">
                                    <h5>12- Depuis quand ?</h5>
                                </label>
                                <div>
                                    <input type="text" name="questions-procedure-immigration1"
                                        id="questions-procedure_immigration1" class="form-control"
                                        value="{{ $candidat->ficheConsultation ? $candidat->ficheConsultation->reponse12 ?? null : null }}">
                                </div>
                            </div>

                            <div class="mb-3 d-flex justify-content-between">
                                <label class="form-label text-xl text-dark">
                                    <h5>13- Quel programme ? et quelle a été la décision ?</h5>
                                </label>
                                <div>
                                    <input type="text" name="questions-procedure-immigration2"
                                        id="questions-procedure_immigration2" class="form-control"
                                        value="{{ $candidat->ficheConsultation ? $candidat->ficheConsultation->reponse13 ?? null : null }}">
                                </div>
                            </div>
                        </div>

                        <!-- Question 14 -->
                        <div class="d-flex justify-content-between">
                            <label class="form-label text-xl text-dark">
                                <h5>14- Avez-vous un diplôme d'études (secondaire, professionnel..) ?</h5>
                            </label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="diplome_etudes"
                                        id="diplome_etudes_oui" value="oui"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse14 === 'oui' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="diplome_etudes_oui">Oui</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="diplome_etudes"
                                        id="diplome_etudes_non" value="non"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse14 === 'non' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="diplome_etudes_non">Non</label>
                                </div>
                            </div>
                            <!-- Condition to show the question on the year of obtaining the diploma if the answer is "Yes" -->

                        </div>
                        <div class="question-diplome-etudes"
                            style="{{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse14 === 'oui' ? 'display:block;' : 'display:none;' }}">
                            <div class="mb-3 d-flex justify-content-between">
                                <label for="annee_obtention_diplome" class="form-label text-xl text-dark">
                                    <h5>15 - Si oui, quelle est l'année d'obtention du diplôme ?</h5>
                                </label>
                                <div>
                                    <input type="text" name="annee_obtention_diplome" id="annee_obtention_diplome"
                                        class="form-control"
                                        value="{{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse14 === 'oui' ? $candidat->ficheConsultation->reponse15 : 'Pas de diplomes' }}">
                                </div>
                            </div>
                        </div>

                        <!-- Question 15 -->
                        <div class="mb-3 d-flex justify-content-between">
                            <label class="form-label text-xl text-dark">
                                <h5>16- Avez-vous un membre de votre famille déjà au Canada ?</h5>
                            </label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="membre_famille_canada"
                                        id="membre_famille_canada_oui" value="oui"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse16 === 'oui' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="membre_famille_canada_oui">Oui</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="membre_famille_canada"
                                        id="membre_famille_canada_non" value="non"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse16 === 'non' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="membre_famille_canada_non">Non</label>
                                </div>
                            </div>
                        </div>


                        <!-- Question 16 -->
                        <div class="mb-3 d-flex justify-content-between">
                            <label class="form-label text-xl text-dark">
                                <h5>17- Comptez-vous immigrer seul(e) ou en famille ?</h5>
                            </label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="immigrer_seul_ou_famille"
                                        id="immigrer_seul" value="seul"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse17 === 'seul' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="immigrer_seul">Seul(e)</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="immigrer_seul_ou_famille"
                                        id="immigrer_en_famille" value="famille"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse17 === 'famille' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="immigrer_en_famille">En famille</label>
                                </div>
                            </div>
                        </div>

                        <!-- Question 17 -->
                        <div class="mb-3 d-flex justify-content-between">
                            <label class="form-label text-xl text-dark">
                                <h5>18- Parlez-vous d'autres langues à part le français ?</h5>
                            </label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="langues_parlees"
                                        id="langues_parlees_oui" value="oui"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse18 === 'oui' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="langues_parlees_oui">Oui</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="langues_parlees"
                                        id="langues_parlees_non" value="non"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse18 === 'non' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="langues_parlees_non">Non</label>
                                </div>
                            </div>
                        </div>

                        <!-- Question 18 -->
                        <div class="mb-3 d-flex justify-content-between">
                            <label class="form-label text-xl text-dark">
                                <h5>19- Avez-vous fait un test de connaissances linguistiques ?</h5>
                            </label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"
                                        name="test_connaissances_linguistiques"
                                        id="test_connaissances_linguistiques_oui" value="oui"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse19 === 'oui' ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="test_connaissances_linguistiques_oui">Oui</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"
                                        name="test_connaissances_linguistiques"
                                        id="test_connaissances_linguistiques_non" value="non"
                                        {{ $candidat->ficheConsultation && $candidat->ficheConsultation->reponse19 === 'non' ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="test_connaissances_linguistiques_non">Non</label>
                                </div>
                            </div>
                        </div>


                        <h3 class="mb-6 text-center">CONJOINT / EPOUX / EPOUSE</h3>


                        <!-- Question 1 -->
                        <div class="mb-3 d-flex justify-content-between">
                            <label class="form-label text-xl text-dark">
                                <h5>20 - Quel est son niveau de scolarité ?</h5>
                            </label>
                            <div>
                                <input type="text" name="niveau_scolarite_conjoint" id="niveau_scolarite_conjoint"
                                    class="form-control"
                                    value="{{ $candidat->ficheConsultation ? $candidat->ficheConsultation->reponse20 ?? null : null }}">


                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div class="mb-3 d-flex justify-content-between">
                            <label class="form-label text-xl text-dark">
                                <h5>2- Quel est votre domaine de formation ?</h5>
                            </label>
                            <div>
                                <input type="text" name="domaine_formation_conjoint"
                                    id="domaine_formation_conjoint" class="form-control"
                                    value="{{ $candidat->ficheConsultation ? $candidat->ficheConsultation->reponse21 ?? null : null }}">


                            </div>
                        </div>

                        <!-- Question 3 -->
                        <div class="mb-3 d-flex justify-content-between">
                            <label class="form-label text-xl text-dark">
                                <h5>3- Quel est votre âge ?</h5>
                            </label>
                            <div>
                                <input type="text" name="age_conjoint" id="age_conjoint" class="form-control"
                                    value="{{ $candidat->ficheConsultation ? $candidat->ficheConsultation->reponse22 ?? null : null }}">

                            </div>
                        </div>


                        <h3 class="mb-6 text-center">CONNAISSANCES LINGUISTIQUES</h3>

                        <!-- Question 22 -->
                        <div class="mb-3 d-flex justify-content-between">
                            <label class="form-label text-xl text-dark">
                                <h5>1- Niveau en français</h5>
                            </label>
                            <div>
                                <input type="text" name="niveau_francais" id="niveau_francais"
                                    class="form-control" value="{{ $candidat->ficheConsultation->reponse23 ?? '' }}">
                            </div>
                        </div>

                        <!-- Question 23 -->
                        <div class="mb-3 d-flex justify-content-between">
                            <label class="form-label text-xl text-dark">
                                <h5>2- Niveau en anglais</h5>
                            </label>
                            <div>
                                <input type="text" name="niveau_anglais" id="niveau_anglais" class="form-control"
                                    value="{{ $candidat->ficheConsultation->reponse24 ?? '' }}">
                            </div>
                        </div>

                        <!-- Question 24 -->
                        <div class="mb-3 d-flex justify-content-between">
                            <label class="form-label text-xl text-dark">
                                <h5>3- Quel est l'âge de vos enfants ?</h5>
                            </label>
                            <div>
                                <input type="text" name="age_enfants_linguistique" id="age_enfants_linguistique"
                                    class="form-control" value="{{ $candidat->ficheConsultation->reponse25 ?? '' }}">
                            </div>
                        </div>

                        <!-- Question 25 -->
                        <div class="mb-3 d-flex justify-content-between">
                            <label class="form-label text-xl text-dark">
                                <h5>4- Quel est leur niveau de scolarité ?</h5>
                            </label>
                            <div>
                                <input type="text" name="niveau_scolarite_enfants" id="niveau_scolarite_enfants"
                                    class="form-control" value="{{ $candidat->ficheConsultation->reponse26 ?? '' }}">
                            </div>
                        </div>

                        <h3 class="mb-6 text-center">RESUME DU PROFIL</h3>

                        <div class="mb-6 d-flex justify-content-between align-items-center">
                            <textarea class="form-control" id="remarque_agent" name="remarque_agent" style="height: 8rem"> {{ $candidat->remarque_agent ?? '' }} </textarea>
                        </div>

                        <h3 class="mb-6 text-center">QUESTION DU CANDIDAT</h3>

                        <div class="mb-6 d-flex justify-content-between align-items-center">
                            <textarea class="form-control" id="reponse27" name="reponse27" style="height: 6rem">
                                {{ $candidat->ficheConsultation->reponse27 ?? '' }}
                                </textarea>

                            <textarea class="form-control ms-2 mx-2 " id="reponse28" name="reponse28" style="height: 6rem">
                                {{ $candidat->ficheConsultation->reponse28 ?? '' }}
                            </textarea>

                            <textarea class="form-control " id="reponse29" name="reponse29" style="height: 6rem">
                                {{ $candidat->ficheConsultation->reponse29 ?? '' }}
                            </textarea>

                        </div>

                        <h3 class="mb-6 text-center">CV</h3>

                        <div class="d-flex justify-content-between mb-2 mt-5 border rounded p-2">
                            <div class="form-group">
                                <label for="cv" class="form-label"> Ajouter un CV (PDF uniquement) :</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input form-control" id="cv" name="cv" accept=".pdf">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cv" class="form-label">CV :</label>
                                @if ($candidat->ficheConsultation && $candidat->ficheConsultation->lien_cv)
                                    <p>
                                        <a href="{{ asset($candidat->ficheConsultation->lien_cv) }}"
                                            target="_blank">
                                            Voir le CV
                                        </a>
                                    </p>
                                @else
                                    <p>Aucun fichier CV téléchargé</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-center d-flex align-items-center justify-content-around">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                    </div>
            </div>
            <div id="loadingOverlay" class="loading-overlay">
                <div class="loading-spinner"></div>
            </div>

            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $(".afficherQuestionnaire{{$candidat->id}}").click(function() {
            $(".questionnaire-form{{$candidat->id}}").toggle(); 
        });
    });
</script>

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

    function handleTextareaInput(textarea) {
        const label = document.querySelector('label[for="remarques"]');
        if (textarea.value.trim() !== '') {
            label.classList.add('d-none');
        } else {
            label.classList.remove('d-none');
        }
    }
</script>
