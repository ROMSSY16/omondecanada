@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3">
                    <div class="bg-gradient-dark shadow-primary border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                        <div class="p-2 border-radius-lg w-40 ">
                            <h3 class="text-white">
                               Les succursales Omonde canada
                            </h3>
                        </div>
                        <div class="d-flex align-items-center justify-content-around w-50">
                            <button type="button" class="btn bg-primary text-white circle" data-bs-toggle="modal" data-bs-target="#addSuccursale">CREER UNE SUCCURSALE</button>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2 ">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="text-center mb-4">Echange de monnaie en FCFA</h4>
                            <div class="table-responsive p-0" style="max-height: 700px; min-height: 700px; overflow-y: auto;">
                                <table class="table align-items-center justify-content-center mb-0 bg-white">
                                <tbody>
                                    <tr>
                                        <form action="{{ route('exchange_rates.update') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <td>
                                                <div class="d-flex px-2">
                                                    <h6 class="p-2 text-md">1 $</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-md font-weight-bold mb-0"> = </p>
                                            </td>
                                            <td style="width:30%">
                                                <input type="number" class="form-control mb-0" name="rate_fcfa" value="{{ $exchangeRateUsdToFcfa }}" required/>
                                            </td>
                                            <td>
                                                <p class="text-md font-weight-bold mb-0"> FCFA </p>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn-primary btn-sm">
                                                    <i class="material-icons text-xl" style="font-size: 1rem;">edit</i>Modifier
                                                </button>
                                            </td>
                                        </form>
                                    </tr>
                                </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="table-responsive p-0" style="max-height: 700px; min-height: 700px; overflow-y: auto;">
                                <table class="table align-items-center justify-content-center mb-0 bg-white">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NOM DU PAYS
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                MONTANT DE CONSULTATION
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                DEVISE 
                                            </th>              
                                            <th class="text-uppercase text-secondary text-left text-xxs font-weight-bolder opacity-7 ps-2 ">
                                                ACTIONS
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($succursales as $succursale)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <h6 class="p-2 text-md">{{ $succursale->label }}</h6>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-md font-weight-bold mb-0"> {{ $succursale->montant }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-md font-weight-bold mb-0">
                                                        {{ $succursale->devis }}</p>
                                                </td>
                                                
                                                <td>
                                                    <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSuccursale{{ $succursale->id }}"> <i class="material-icons text-xl" style="font-size: 1rem;">edit</i>
                                                </td>
                                            
                                            </tr>
                                            {{-- Modal modifier prospect --}}
                                            <div class="modal z-index-1 fade" id="editSuccursale{{ $succursale->id }}" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modifier {{ $succursale->label }}</h5>
                                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="modal-body">
                                                                <form action="{{ route('succursale.update', $succursale->id) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="label" class="form-label">Nom du pays</label>
                                                                            <input type="text" name="label" id="label" class="form-control" value="{{ old('label') ?? $succursale->label }}" required>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="montant" class="form-label">Montant</label>
                                                                            <input type="text" name="montant" id="montant" class="form-control" value="{{ old('montant') ??  $succursale->montant }}" required>
                                                                        </div>
                                                                        <div class="col-md-12 mb-3">
                                                                            <label for="devis" class="form-label">devis</label>
                                                                            <input type="text" name="devis" id="devis" class="form-control" value="{{old('devis') ?? $succursale->devis }}" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="text-center d-flex justify-content-around">
                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                                                                        <button type="submit" class="btn btn-success">Modifier</button>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        
                </div>
            </div>
        </div>
    </div>
    <div class="modal z-index-2 fade" id="addSuccursale" tabindex="-1" role="dialog" aria-labelledby="addSuccursaleLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSuccursaleLabel">Créer une succursale</h5>
                    
                </div>
                <div class="modal-body">
                    <form action="{{ route('succursale.store') }}" method="post" class=" bg-white rounded p-4 w-100" enctype="multipart/form-data">
                        @csrf 
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="label" class="form-label">Nom du pays</label>
                                <input type="text" name="label" id="label" class="form-control" value="{{ old('label') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="montant" class="form-label">Montant</label>
                                <input type="text" name="montant" id="montant" class="form-control" value="{{ old('montant') }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="devis" class="form-label">devis</label>
                                <input type="text" name="devis" id="devis" class="form-control" value="{{ old('devis') }}" required>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Fermer">
                                Fermer
                            </button>
                            <button type="submit" class="btn btn-success">VALIDER</button>
                        </div>
                    </form>
                    @if (session('error'))
                        <div class="alert text-sm text-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmAction(formId) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Cette action ne peut pas être annulée!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, Je confirme!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
        document.addEventListener("DOMContentLoaded", function() {
            const allButton = document.querySelector('#all');
            const rows = document.querySelectorAll('tbody tr');
            allButton.addEventListener('click', function() {
                rows.forEach(function(row) {
                    row.style.display = '';
                });
            });
        });
    </script>
  
@endsection
