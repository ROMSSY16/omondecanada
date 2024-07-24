@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-lg-12">


                @php
                    use Carbon\Carbon;
                    use Illuminate\Support\Facades\Auth;

                    $moisActuel = Carbon::now()->format('m');

                    $utilisateurConnecte = Auth::user();

                    $totalCaisseMoisActuel = \App\Models\Entree::whereMonth('date', $moisActuel)
                        ->whereHas('utilisateur', function ($query) use ($utilisateurConnecte) {
                            $query->where('id_succursale', $utilisateurConnecte->id_succursale);
                        })
                        ->sum('montant');

                    $totalDepenseMoisActuel = \App\Models\Depense::whereMonth('date', $moisActuel)
                        ->whereHas('utilisateur', function ($query) use ($utilisateurConnecte) {
                            $query->where('id_succursale', $utilisateurConnecte->id_succursale);
                        })
                        ->sum('montant');
                @endphp
                @php

                    $moisActuel = Carbon::now()->format('m');

                    $totalDepenseMoisActuel = \App\Models\Depense::whereMonth('date', $moisActuel)->sum('montant');

                    // Date de début et de fin de la période
                    $dateDebut = Carbon::now();
                    $dateFin = Carbon::now();

                    // Date de début et de fin de semaine
                    $dateDebutSemaine = $dateDebut->startOfWeek();
                    $dateFinSemaine = $dateFin->endOfWeek();

                @endphp

                <div class="row">
                    <div class="col-xl-6 mb-4">
                        <div class="card">
                            <div class="card-header mx-4 p-3 text-center">
                                <div
                                    class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                    <i class="material-icons opacity-10">account_balance</i>
                                </div>
                            </div>
                            <div class="card-body pt-0 p-3 text-center">
                                <h5 class="text-center mb-0">Paiements</h5>
                                <span class="text-xs">{{ Carbon::now()->format('F') }}</span>
                                <hr class="horizontal dark my-3">
                                <h4 class="mb-5 text-center text-success">
                                    {{ number_format($totalCaisseMoisActuel, 0, '.', ' ') }} FCFA</h4>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header mx-4 p-3 text-center">
                                <div
                                    class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                    <i class="material-icons opacity-10">wallet</i>
                                </div>
                            </div>
                            <div class="card-body pt-0 p-3 text-center">
                                <h5 class="text-center mb-0">Dépenses</h5>
                                <span class="text-xs">{{ Carbon::now()->format('F') }}</span>
                                <hr class="horizontal dark my-3">
                                <h4 class="mb-5 text-center text-danger">
                                    {{ number_format($totalDepenseMoisActuel, 0, '.', ' ') }} FCFA</h4>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.Banque.tableauTransactionParSemaine')
    </div>

@endsection
