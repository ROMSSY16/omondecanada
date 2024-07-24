@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3">
                    <div
                        class="bg-gradient-dark shadow-primary border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                        <div class="p-2 border-radius-lg w-40 bg-white">
                            <input type="text" id="searchInput"
                                class="form-control text-dark text-md bg-transparent border-0 p-1"
                                placeholder="Rechercher...">
                        </div>
                        <button class="btn bg-primary text-white circle" data-bs-toggle="modal"
                            data-bs-target="#addContactModal">
                            <i class="material-icons">add</i> Ajouter un prospect
                        </button>
                        @include('Commercial.Partials.AjouterContact')
                    </div>


                    @include('Commercial.Partials.TableCandidat')
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
@endsection
