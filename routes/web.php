<?php

use App\Http\Controllers\AdministratifController;
use App\Http\Controllers\CommercialController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\EntreeController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\consultationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ConsultanteController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\FicheDeRenseignementController;
use App\Http\Controllers\FicheRenseignementController;
use App\Http\Controllers\InformatiqueController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Connexion.connexionPage');
});
// Routes d'authentification
Route::get('connexion', [AuthController::class, 'showLoginForm'])->name('connexion.form');
Route::post('connexion', [AuthController::class, 'login'])->name('login');
Route::get('sign-in', [HomeController::class, 'sign-in'])->name('sign-in');
// web.php

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    // Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::middleware('isCommercial')->group(function () {
        Route::prefix('commercial')->name('commercial.')->group(function () {

            Route::get('Dashboard', [CommercialController::class, 'Dashboard'])->name('dashboard');
            Route::get('AppelsChart', [CommercialController::class, 'appelChartData']);
            Route::get('ConsultationsChart', [CommercialController::class, 'consultationChartData']);
            Route::get('Contacts', [CommercialController::class, 'Contacts'])->name('contact');
            Route::post('Contacts/AjouterProspect', [CommercialController::class, 'addProspect'])->name('add_prospect');
            Route::put('Contacts/ModifierProspect/{id}', [CommercialController::class, 'addProspect'])->name('modifier_prospect');
            Route::get('RendezVous', [CommercialController::class, 'RendezVous'])->name('rendez_vous');
            Route::get('RendezVous/ConsultationPayee/{id}/{statut}', [CommercialController::class, 'changeStatutConsultationPayee'])->name('change_statut_consultation');
            Route::get('RendezVous/RendezVousEffectue/{id}/{statut}', [CommercialController::class, 'changeStatutRendezVous'])->name('change_statut_rendez_vous');

            //A revoir
            Route::get('Consultation', [AdministratifController::class, 'Consultation'])->name('consultation');
        });
    });

    //Routes Administratif
    Route::middleware('isAdministratif')->group(function () {
        Route::prefix('administratif')->name('administratif.')->group(function () {

            Route::get('Dashboard', [AdministratifController::class, 'Dashboard'])->name('dashboard');

            Route::get('EntreeChartData', [AdministratifController::class, 'EntreeChartData']);
            Route::get('Clients', [AdministratifController::class, 'Clients'])->name('clients');
            Route::put('Clients/ModifierFicheConsultation/{idCandidat}', [AdministratifController::class, 'CreerOuModifierFiche'])->name('creer_ou_modifier_fiche');
            Route::put('Clients/ModifierDateConsultation/{id}', [AdministratifController::class, 'ModifierDateConsultation'])->name('creer_ou_modifier_date_consultation');
            Route::post('DossierClient/ModifierTypeVisa/{id}', [AdministratifController::class, 'ModifierTypeVisa'])->name('modifier_type_visa');

            Route::get('DossierClients', [AdministratifController::class, 'DossierClients'])->name('dossier_clients');
            Route::get('Banque', [AdministratifController::class, 'Banque'])->name('banque');
            Route::get('Consultation', [AdministratifController::class, 'Consultation'])->name('consultation');
            Route::post('UpdateTag/{candidatId}/{tagId}',[DossierController::class, 'Updatetag'])->name('update_tag');
            Route::get('ficheRens/questions', [AdministratifController::class, 'showForm'])->name('question_fiche');
            Route::post('ficheRens/{candidatId}', [FicheRenseignementController::class, 'store'])->name('fiche.renseignement.store');

        });
    });

    Route::middleware('isConsultante')->group(function () {
        Route::prefix('consultante')->name('consultante.')->group(function () {
            //Routes Consultatnte
            Route::get('Dashboard', [ConsultanteController::class, 'Dashboard'])->name('dashboard');
            Route::get('DossierClient', [ConsultanteController::class, 'DossierClient'])->name('dossierClient');
            Route::post('DossierClient/AjouterFichiersCandidat/{candidatId}', [DossierController::class, 'ajouterFichiersConsultante'])->name('ajout_fichiers_consultante');
            Route::get('DossierClient/ficheRens/{candidatId}/view', [FicheRenseignementController::class, 'view'])->name('fiche.renseignement.view');

        });
    });

    Route::middleware('isDirection')->group(function () {
        Route::prefix('direction')->name('direction.')->group(function () {
            //Route Direction
            Route::get('Dashboard', [DirectionController::class, 'Dashboard'])->name('dashboard');
            Route::get('Dashboard/DataSuccursale', [DirectionController::class, 'dataSuccursale'])->name('data');;
            Route::get('Banque', [DirectionController::class, 'Banque'])->name('banque');
            Route::get('ChartEnsemble', [DirectionController::class, 'ChartData']);
            Route::get('Consultation', [DirectionController::class, 'Consultation'])->name('consultation');
            Route::get('DossierClient', [DirectionController::class, 'DossierClient'])->name('dossier_client');
            Route::get('Equipe', [DirectionController::class, 'Equipe'])->name('equipe');

        });
    });

    Route::prefix('consultation')->name('consultation.')->group(function () {

        Route::get('list', [InformatiqueController::class, 'Consultation'])->name('dashboard');
        Route::post('CreerConsultation', [consultationController::class, 'creerConsultation'])->name('creer_consultation');
        Route::put('ModiferConsultation/{id}', [consultationController::class, 'ModifierConsultation'])->name('modifier_consultation');
        Route::delete('SupprimerConsultation/{id}', [ConsultationController::class, 'SupprimerConsultation'])->name('supprimer_consultation');

        Route::get('Clients', [InformatiqueController::class, 'Client'])->name('client');

        Route::get('Equipe', [InformatiqueController::class, 'Equipe'])->name('equipe');

    });



Route::post('ajoutDepense', [DepenseController::class, 'ajoutDepense'])->name('ajoutDepense');
Route::post('Banque', [EntreeController::class, 'ajoutEntree'])->name('ajoutEntree');
Route::get('Banque', [HomeController::class, 'Banque'])->name('Banque');
Route::get('DossierClients', [HomeController::class, 'allClient'])->name('dossier_clients');
Route::get('DossierContacts', [HomeController::class, 'allCandidat'])->name('DossierContacts');
Route::get('Consultation', [consultationController::class, 'listeConsultantes'])->name('Consultation');
Route::get('dashBoardConsultante', [HomeController::class, 'dashBoardConsultante'])->name('dashBoardConsultante');
Route::get('equipeView', [HomeController::class, 'equipeView'])->name('equipeView');
Route::get('documentAgent', [HomeController::class, 'documentAgent'])->name('documentAgent');



Route::get('adminDashboard', [HomeController::class, 'adminDashboard'])->name('admin_dashboard');
Route::get('prochainesConsultations', [HomeController::class, 'prochainesConsultations'])->name('prochainesConsultations');

Route::get('virtual-reality', [HomeController::class, 'virtual-reality'])->name('virtual-reality');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//
Route::put('/modifierContact/{id}', [Controller::class, 'modifierFormulaire'])->name('modifierContact');
Route::post('DossierContacts', [Controller::class, 'soumettreFormulaire'])->name('ajoutContact');

// Exemple de route dans votre fichier web.php
Route::get('/recherche-candidat', [Controller::class, 'rechercheCandidat'])->name('rechercheCandidat');
Route::get('/Consultation/{id}', [ConsultanteController::class, 'getListCandidatByConsultation'])->name('listcandidats');
Route::get('/Consultation/{id}/{id_candidat}', [ConsultanteController::class, 'getCandidatByConsultation'])->name('candidat');
Route::get('/ficheConsultation/{id_candidat}', [ConsultanteController::class, 'getCandidatFiche'])->name('candidatFiche');

// routes/web.php
Route::post('/ajouterCandidatAConsultation', [Controller::class, 'ajouterCandidatAConsultation']);
Route::post('/ajouterTypeDeVisa', [Controller::class, 'ajouterTypeDeVisa']);


Route::get('/creer-utilisateur', [UtilisateurController::class, 'formulaireCreation'])->name('creer-utilisateur.formulaire');
Route::post('/creer-utilisateur', [UtilisateurController::class, 'creer'])->name('creer-utilisateur.creer');
Route::post('/modifier-utilisateur/{id}', [UtilisateurController::class, 'modifier'])->name('ModifierUser');



Route::get('/dossier', [HomeController::class, 'dossier'])->name('dossier');


Route::post('/save-remarques/{id}', [HomeController::class, 'saveRemarques'])->name('SaveRemarque');


Route::delete('/SupprimerDocumentCandidat/{id}', [DossierController::class, 'delFichierCandidat'])->name('DelFichierCandidat');
Route::delete('/supprimerFichierAgent/{userId}/{fileName}', [DossierController::class, 'supprimerFichierAgent'])->name('supprimerFichierAgent');

Route::post('/ajouterFichiersCandidat/{candidatId}', [DossierController::class, 'ajouterFichiersCandidat'])->name('ajoutFichiersCandidat');
Route::post('/ajouterFichiersAgent/{userId}', [DossierController::class, 'ajouterFichiersAgent'])->name('ajoutFichiersAgent');


Route::get('/toggle-consultation/{candidatId}', [consultationController::class, 'toggleConsultation'])->name('toggleConsultation');

Route::get('/waiting-list/{consultation_id}', [ConsultationController::class, 'getConsultationWaitingList'])->name('listedattente');


//Route Documents
Route::get('/transactions/{id}/print', [TransactionController::class, 'print'])->name('transactions.print');
Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);
Route::get('/print/devis/{id}', [PDFController::class, 'printDevis'])->name('print.devis');
Route::get('/print/serviceContract/{id}', [PDFController::class, 'printContrat'])->name('print.serviceContract');
Route::get('/print/professionalServiceContract/{id}', [PDFController::class, 'printProfessionalServiceContract'])->name('print.professionalServiceContract');

//meme nom de name
//Route::get('/print-professional-service-contract/{id}', [PDFController::class, 'printProfessionalServiceContract'])->name('print.professionalServiceContract');

    
});


