<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EntreeController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\CommercialController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ConsultanteController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\consultationController;
use App\Http\Controllers\InformatiqueController;
use App\Http\Controllers\AdministratifController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\FicheRenseignementController;
use App\Http\Controllers\FicheDeRenseignementController;
use App\Http\Controllers\RendezvousController;

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

    Route::prefix('equipes')->name('equipes.')->group(function () {
        Route::get('index', [EquipeController::class, 'index'])->name('index');
        Route::get('create', [EquipeController::class, 'create'])->name('create');
        Route::post('store', [EquipeController::class, 'store'])->name('store');
        Route::post('update', [EquipeController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [EquipeController::class, 'destroy'])->name('destroy');
        Route::get('show/{id}', [EquipeController::class, 'show'])->name('show');
        Route::get('edit/{id}', [EquipeController::class, 'edit'])->name('edit');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('index', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::post('update', [UserController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('show/{id}', [UserController::class, 'show'])->name('show');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
    });

    Route::prefix('role')->name('role.')->group(function () {
        Route::get('list', [RoleController::class, 'listRole'])->name('index');
        Route::get('create', [RoleController::class, 'createRole'])->name('create');
        Route::post('store', [RoleController::class, 'store'])->name('store');
        Route::post('update/{slug}', [RoleController::class, 'update'])->name('update');
        Route::get('destroy/{slug}', [RoleController::class, 'destroy'])->name('destroy');

        Route::get('edit/{slug}', [RoleController::class, 'edit'])->name('edit');
    });

    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('index', [PermissionController::class, 'index'])->name('index');
        Route::get('create', [PermissionController::class, 'create'])->name('create');
        Route::post('store', [PermissionController::class, 'store'])->name('store');
        Route::post('update', [PermissionController::class, 'update'])->name('update');
        Route::get('destroy/{slug}', [PermissionController::class, 'destroy'])->name('destroy');
        Route::get('show/{slug}', [PermissionController::class, 'show'])->name('show');
        Route::get('edit/{slug}', [PermissionController::class, 'edit'])->name('edit');
    });

    Route::prefix('consultation')->name('consultation.')->group(function () {
        Route::get('index', [PermissionController::class, 'index'])->name('index');
        Route::get('create', [PermissionController::class, 'create'])->name('create');
        Route::post('store', [PermissionController::class, 'store'])->name('store');
        Route::post('update', [PermissionController::class, 'update'])->name('update');
        Route::get('destroy/{slug}', [PermissionController::class, 'destroy'])->name('destroy');
        Route::get('show/{slug}', [PermissionController::class, 'show'])->name('show');
        Route::get('edit/{slug}', [PermissionController::class, 'edit'])->name('edit');
    });
    Route::prefix('client')->name('client.')->group(function () {
        Route::get('index', [PermissionController::class, 'index'])->name('index');
        Route::get('create', [PermissionController::class, 'create'])->name('create');
        Route::post('store', [PermissionController::class, 'store'])->name('store');
        Route::post('update', [PermissionController::class, 'update'])->name('update');
        Route::get('destroy/{slug}', [PermissionController::class, 'destroy'])->name('destroy');
        Route::get('show/{slug}', [PermissionController::class, 'show'])->name('show');
        Route::get('edit/{slug}', [PermissionController::class, 'edit'])->name('edit');
    });
    Route::prefix('contact')->name('contact.')->group(function () {
        Route::get('index', [ContactController::class, 'index'])->name('index');
        Route::get('create', [ContactController::class, 'create'])->name('create');
        Route::post('store', [ContactController::class, 'store'])->name('store');
        Route::put('update/{id}', [ContactController::class, 'update'])->name('update');
        Route::get('destroy/{slug}', [ContactController::class, 'destroy'])->name('destroy');
        Route::get('show/{slug}', [ContactController::class, 'show'])->name('show');
        Route::get('edit/{slug}', [ContactController::class, 'edit'])->name('edit');
        Route::get('succursale', [ContactController::class, 'succursaleContacts'])->name('succursale');
    });
    Route::prefix('rendezvous')->name('rendezvous.')->group(function () {
        Route::get('index', [RendezvousController::class, 'index'])->name('index');
        Route::get('create', [RendezvousController::class, 'create'])->name('create');
        Route::post('store', [RendezvousController::class, 'store'])->name('store');
        Route::post('update', [RendezvousController::class, 'update'])->name('update');
        Route::get('destroy/{slug}', [RendezvousController::class, 'destroy'])->name('destroy');
        Route::get('show/{slug}', [RendezvousController::class, 'show'])->name('show');
        Route::get('edit/{slug}', [RendezvousController::class, 'edit'])->name('edit');
    });
    Route::prefix('banque')->name('banque.')->group(function () {
        Route::get('index', [PermissionController::class, 'index'])->name('index');
        Route::get('create', [PermissionController::class, 'create'])->name('create');
        Route::post('store', [PermissionController::class, 'store'])->name('store');
        Route::post('update', [PermissionController::class, 'update'])->name('update');
        Route::get('destroy/{slug}', [PermissionController::class, 'destroy'])->name('destroy');
        Route::get('show/{slug}', [PermissionController::class, 'show'])->name('show');
        Route::get('edit/{slug}', [PermissionController::class, 'edit'])->name('edit');
    });
    Route::prefix('candidat')->name('candidat.')->group(function () {
        Route::get('index', [CandidatController::class, 'index'])->name('index');
        Route::get('create', [CandidatController::class, 'create'])->name('create');
        Route::post('store', [CandidatController::class, 'store'])->name('store');
        Route::post('update', [CandidatController::class, 'update'])->name('update');
        Route::get('destroy/{slug}', [CandidatController::class, 'destroy'])->name('destroy');
        Route::get('show/{slug}', [CandidatController::class, 'show'])->name('show');
        Route::get('edit/{slug}', [CandidatController::class, 'edit'])->name('edit');
        Route::get('succursale', [CandidatController::class, 'succursale'])->name('succursale');
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


