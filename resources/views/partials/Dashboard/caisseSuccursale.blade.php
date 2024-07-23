@php
    use Carbon\Carbon;

    // Obtenez le mois actuel
    $moisActuel = Carbon::now()->format('m');

    // Obtenez l'id de la succursale de l'utilisateur connecté
    $idSuccursaleUtilisateur = auth()->user()->id_succursale;

    // Obtenez le total du mois en cours pour l'utilisateur avec la succursale de l'utilisateur connecté
    $totalCourant = \App\Models\Entree::whereMonth('date', $moisActuel)
        ->whereHas('utilisateur', function ($query) use ($idSuccursaleUtilisateur) {
            $query->where('id_succursale', $idSuccursaleUtilisateur);
        })
        ->sum('montant');

    // Obtenez le mois précédent
    $moisPrecedent = Carbon::now()->subMonth()->format('m');

    // Obtenez le total du mois précédent pour l'utilisateur avec la succursale de l'utilisateur connecté
    $totalMoisPrecedent = \App\Models\Entree::whereMonth('date', $moisPrecedent)
        ->whereHas('utilisateur', function ($query) use ($idSuccursaleUtilisateur) {
            $query->where('id_succursale', $idSuccursaleUtilisateur);
        })
        ->sum('montant');

    // Calculez le pourcentage d'évolution
    $pourcentageEvolution = ($totalMoisPrecedent != 0)
        ? (($totalCourant - $totalMoisPrecedent) / $totalMoisPrecedent) * 100
        : 0;
@endphp

<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
        <div class="card-header p-3 pt-2">
            <div class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">account_balance</i>
            </div>
            <div class="text-end">
                <p class="text-xl mb-0 text-capitalize">Caisse Succursale</p>
                <h3 class="mb-0 pt-2">{{ number_format($totalCourant, 0, '.', ' ') }} FCFA</h3>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
            <p class="mb-0">
                <span class="text-success text-sm font-weight-bolder">
                    @if($pourcentageEvolution > 0)
                        +{{ number_format($pourcentageEvolution, 0) }}%
                    @elseif($pourcentageEvolution < 0)
                        {{ number_format($pourcentageEvolution, 0) }}%
                    @else
                        Aucun changement
                    @endif
                </span> par rapport au mois précédent
            </p>
        </div>
    </div>
</div>
