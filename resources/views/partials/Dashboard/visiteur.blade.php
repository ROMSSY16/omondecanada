@php
    use Carbon\Carbon;

    // Obtenez le mois actuel
    $moisActuel = Carbon::now()->format('m');

    // Obtenez l'utilisateur connecté
    $utilisateurConnecte = auth()->user();

    // Obtenez le total du mois en cours pour tous les candidats de la succursale de l'utilisateur connecté
    $totalCandidatsCourant = \App\Models\Candidat::whereMonth('date_enregistrement', $moisActuel)
        ->whereHas('utilisateur', function ($query) use ($utilisateurConnecte) {
            $query->where('id_succursale', $utilisateurConnecte->id_succursale);
        })
        ->count();

    // Obtenez le mois précédent
    $moisPrecedent = Carbon::now()->subMonth()->format('m');

    // Obtenez le total du mois précédent pour tous les candidats de la succursale de l'utilisateur connecté
    $totalCandidatsMoisPrecedent = \App\Models\Candidat::whereMonth('date_enregistrement', $moisPrecedent)
        ->whereHas('utilisateur', function ($query) use ($utilisateurConnecte) {
            $query->where('id_succursale', $utilisateurConnecte->id_succursale);
        })
        ->count();

    // Calculez le pourcentage d'évolution pour tous les candidats de la succursale de l'utilisateur connecté
    $pourcentageEvolutionCandidats = ($totalCandidatsMoisPrecedent != 0)
        ? (($totalCandidatsCourant - $totalCandidatsMoisPrecedent) / $totalCandidatsMoisPrecedent) * 100
        : 0;
@endphp

<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
        <div class="card-header p-3 pt-2">
            <div class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
            </div>
            <div class="text-end">
                <p class="text-xl mb-0 text-capitalize">Candidat - {{ Carbon::now()->format('F') }}</p>
                <h3 class="mb-0 pt-2">{{ $totalCandidatsCourant ?? '0' }}</h3>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
            <p class="mb-0">
                <span class="text-success text-sm font-weight-bolder">
                    @if($pourcentageEvolutionCandidats > 0)
                        +{{ number_format($pourcentageEvolutionCandidats, 0) }}%
                    @elseif($pourcentageEvolutionCandidats < 0)
                        {{ number_format($pourcentageEvolutionCandidats, 0) }}%
                    @else
                        Aucun changement
                    @endif
                </span> par rapport au mois précédent
            </p>
        </div>
    </div>
</div>
