@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3">
                <div class="bg-gradient-dark shadow-primary border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                    <div class="p-2 border-radius-lg w-40 bg-white">
                        <input type="text" id="searchInput"
                            class="form-control text-dark text-md bg-transparent border-0 p-1"
                            placeholder="Rechercher...">
                    </div>
                    <button class="btn bg-primary text-white circle" data-bs-toggle="modal"
                        data-bs-target="#addContactModal">
                        <i class="material-icons">add</i> Ajouter un prospect
                    </button>
                    <a href="{{route('contact.succursale')}}">
                        <button class="btn bg-primary text-white circle">
                            <i class="material-icons">groups</i> Tous les contacts {{ $pays}}
                        </button>
                    </a>
                </div>

                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0" style="max-height: 750px; overflow-y: auto;">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        NOM
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NUMERO</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        PROFFESSION</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                        DATE ENREGISTREMENT</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                
                                @foreach ($data_candidat as $candidat)
                                    <tr data-bs-toggle="modal" data-bs-target="#modifierContactModal{{ $candidat->id }}">
                                        <td>
                                            <div class="d-flex px-2">
                                                <h6 class="p-2 text-md">{{ $candidat->nom }} {{ $candidat->prenom }}</h6>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-md font-weight-bold mb-0">{{ $candidat->numero_telephone }}</p>
                                        </td>
                                        <td>
                                            <span class="text-md font-weight-bold">{{ $candidat->profession }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-md font-weight-bold">
                                                {{ date('d-m-Y', strtotime($candidat->created_at)) }}
                                            </span>
                                        </td>
                                    </tr>
                                  
                                    {{-- modal modifier contact --}}
                                    <div class="modal z-index-1 fade" id="modifierContactModal{{ $candidat->id }}" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modifier Contact</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('contact.update', $candidat->id) }}" method="POST" class="text-start"
                                                        id="modifierContactForm{{ $candidat->id }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <!-- Champs Nom et Prénoms sur la même ligne -->
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="nom" class="form-label">Nom</label>
                                                                <input type="text" name="nom" id="nom" class="form-control"
                                                                        value="{{ $candidat->nom }}" required>
                                                            
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="prenoms" class="form-label">Prénoms</label>
                                                                <input type="text" name="prenoms" id="prenoms" class="form-control"
                                                                    value="{{ $candidat->prenom }}" required>
                                                            </div>
                                                        </div>
                                    
                                                        <div class="row">
                                                            <!-- Champ Pays -->
                                                            <div class="col-md-6 mb-3">
                                                                <label for="pays" class="form-label">Pays</label>
                                                                <input type="text" name="pays" id="pays" class="form-control"
                                                                    value="{{ $candidat->pays }}" required>
                                                            </div>
                                    
                                                            <!-- Champ Ville -->
                                                            <div class="col-md-6 mb-3">
                                                                <label for="ville" class="form-label">Ville</label>
                                                                <input type="text" name="ville" id="ville" class="form-control"
                                                                    value="{{ $candidat->ville }}" required>
                                                            </div>
                                                        </div>
                                    
                                                        <!-- Champ Téléphone -->
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="numero_telephone" class="form-label">Téléphone</label>
                                                                <input type="tel" name="numero_telephone" id="numero_telephone" class="form-control"
                                                                    value="{{ $candidat->numero_telephone }}" required>
                                                            </div>
                                    
                                                            <!-- Champ Email -->
                                                            <div class="col-md-6 mb-3">
                                                                <label for="email" class="form-label">Email</label>
                                                                <input type="email" name="email" id="email" class="form-control"
                                                                    value="{{ $candidat->email }}" required>
                                                            </div>
                                                        </div>
                                    
                                                        <div class="row">
                                                            <!-- Champ Profession -->
                                                            <div class="col-md-6 mb-3">
                                                                <label for="profession" class="form-label">Profession</label>
                                                                <input type="text" name="profession" id="profession" class="form-control"
                                                                    value="{{ $candidat->profession }}" required>
                                                            </div>
                                    
                                    
                                                            <div class="col-md-6 mb-3">
                                                                <label for="date_rdv" class="form-label">Date Rendez Vous</label>
                                                                <input type="date" name="date_rdv" id="date_rdv" class="form-control"
                                                                    value="{{ $candidat->date_rdv }}">
                                                            </div>
                                                        </div>
                                                </div>
                                    
                                                <div class="text-center d-flex justify-content-around">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                                                    <button type="button" class="btn btn-success"
                                                        onclick="$('#modifierContactForm{{ $candidat->id }}').submit()">Enregistrer les
                                                        modifications</button>
                                                </div>
                                    
                                            </div>
                                    
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                                
                            </tbody>
                           
                        </table>
                        
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <!-- Previous Page Link -->
                            <li class="page-item {{ $data_candidat->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $data_candidat->previousPageUrl() }}" tabindex="-1">
                                    <span class="material-icons">
                                        keyboard_arrow_left
                                    </span>
                                   
                                </a>
                            </li>
                
                            <!-- Page Number Links -->
                            @foreach ($data_candidat->getUrlRange(1, $data_candidat->lastPage()) as $page => $url)
                                <li class="page-item {{ $data_candidat->currentPage() == $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                
                            <!-- Next Page Link -->
                            <li class="page-item {{ !$data_candidat->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $data_candidat->nextPageUrl() }}">
                                    <span class="material-icons">
                                        keyboard_arrow_right
                                    </span>
                                   
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                
            </div>
        </div>
    </div>
</div>
{{-- modal add contact --}}
<div class="modal z-index-1 fade" id="addContactModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un prospect</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="contactForm" id="contactForm" action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <div class="form-group">
                                <label for="prenoms" class="form-label">Prénoms</label>
                                <input type="text" name="prenoms" id="prenoms" class="form-control" value="{{old('prenoms')}}" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer les prénoms.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" name="nom" id="nom" class="form-control" value="{{old('nom')}}" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer le nom.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="pays" class="form-label">Pays</label>
                                <input type="text" name="pays" id="pays" class="form-control" value="{{$pays}}" readonly required>
                                
                                <div class="invalid-feedback">
                                    Veuillez sélectionner un pays.
                                </div>
                            </div>                            
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="ville" class="form-label">Ville</label>
                                <input type="text" name="ville" id="ville" class="form-control" value="{{old('ville')}}" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer la ville.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="numero_telephone" class="form-label">Téléphone</label>
                                <input type="tel" name="numero_telephone" id="numero_telephone" class="form-control" value="{{old('numero_telephone')}}" maxlength="10" pattern="\d{10}" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer un numéro de téléphone valide.
                                </div>
                            </div>
                        </div>                            
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer une adresse email valide.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="profession" class="form-label">Profession</label>
                                <input type="text" name="profession" id="profession" class="form-control" value="{{old('profession')}}" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer la profession.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="date_rdv" class="form-label">Date Rendez Vous</label>
                            <input type="date" name="date_rdv" id="date_rdv" class="form-control" value="{{ old('date_rdv') }}" required>
                            <div class="invalid-feedback">
                                Veuillez entrer la date de rendez-vous.
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#contactForm').on('submit', function (event) {
            var form = this;
            
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }

            $(form).addClass('was-validated');
        });
    });
</script>


@endsection
