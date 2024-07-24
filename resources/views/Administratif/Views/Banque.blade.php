@extends('layouts.app')
@section('content')
    <div class="row">
        @if ($hasPoste)
        <div class="col-lg-12">

        <div class="row d-flex justify-content-around mb-4 p-3">
            <div class="col-xl-4 mb-4 ">
                <div class="card">
                    <div class="card-header  p-3 text-center d-flex align-items-center justify-content-between">
                        <div
                            class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                            <i class="material-icons opacity-10">payments</i>
                        </div>
                        <div>
                            <h3 class="text-center mb-0">Paiements</h3>
                            <span class="text-md">{{ ucfirst($moisEnCours)}}</span>
                            
                        </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                        <hr class="horizontal dark my-3">
                        <h2 class="mb-5 text-center text-success">
                            {{ number_format($entreeMensuelSuccursale, 0, '.', ' ') }} {{$devise}}</h2>
                    </div>
                    
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header  p-3 text-center d-flex align-items-center justify-content-between">
                        <div
                            class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                            <i class="material-icons opacity-10">wallet</i>
                        </div>

                        <div>
                            <h3 class="text-center mb-0">Dépenses</h3>
                        <span class="text-md">{{ ucfirst($moisEnCours)}}
                    </span>
                        
                        </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                            <hr class="horizontal dark my-3">
                        <h2 class="mb-5 text-center text-danger">
                            {{ number_format($depenseMensuelSuccursale, 0, '.', ' ') }} {{$devise}}</h2>
                    </div>

                    
                </div>
            </div>


            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header  p-3 text-center d-flex align-items-center justify-content-between">
                        <div
                            class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                            <i class="material-icons opacity-10">account_balance</i>
                        </div>

                        <div>
                            <h3 class="text-center mb-0">Caisse</h3>
                        <span class="text-md">{{ ucfirst($moisEnCours)}}
                    </span>
                        
                        </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                            <hr class="horizontal dark my-3">
                        <h2 class="mb-5 text-center text-dark">
                            {{ number_format(($entreeMensuelSuccursale - $depenseMensuelSuccursale), 0, '.', ' ') }} {{$devise}}</h2>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
        @endif
        <div class="col-12">
            @include('Administratif.Partials.TablePaiement')
        </div>
    </div>
    <div id="loading" class="loading-overlay">
        <div class="loading-spinner"></div>
    </div>
        
@endsection
