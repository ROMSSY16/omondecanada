@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3">
                    <div
                        class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                        <div class="p-2 border-radius-lg w-40 bg-gradient-dark">
                            <input type="text" id="searchInput"
                                class="form-control text-white  text-lg bg-transparent border-0 p-1"
                                placeholder="Rechercher...">
                        </div>
                        <button class="btn bg-gradient-dark circle" data-bs-toggle="modal"
                            data-bs-target="#addContactModal">
                            <i class="material-icons">add</i> Ajouter un candidat
                        </button>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ajouterEntreeModal">
                            <i class="material-icons">add</i> Ajouter une entrée
                        </button>
                        @include('partials.Banque.addEntree')
                        @include('partials.Contact.addContact')
                    </div>


                    @include('partials.Contact.tableCandidat')

                </div>
            </div>
        </div>
    </div>
@endsection