@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-lg-12">
                @php
                    $users = \App\Models\User::all();
                @endphp
        
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h4 class="text-white text-capitalize ps-3">Dossier Client</h4>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0" style="max-height: 750px; overflow-y: auto;">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NOM
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            POSTE
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            SUCCURSALE
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            DOCUMENT
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <h6 class="p-2 text-xl">{{ $user->name }} {{ $user->last_name }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-left">
                                                <h6 class="p-2 text-xl">{{ $user->posteOccupe->label }} </h6>
                                            </td>
                                            <td class="align-middle text-center">
                                                <h6 class="p-2 text-xl">{{ $user->succursale->label }} </h6>
                                            </td>
                                            <td class="align-middle text-center">
                                                <button class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#ajouterFichierModal{{ $user->id }}">
                                                    <i class="material-icons opacity-10" style="font-size: 24px;">add</i>
                                                </button>
                                                <!-- Modal -->
                                                @include('partials.DocumentsAgents.ajoutFicherAgent')
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @include('partials.footer')
    </div>
@endsection
