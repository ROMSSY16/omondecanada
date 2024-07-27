@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3">

                    <div
                        class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                        <div class="p-2 border-radius-lg w-40 bg-white">
                            <input type="text " id="searchInput"
                                class="form-control text-dark  text-lg bg-transparent border-0 p-1"
                                placeholder="Recherche...">



                        </div>
                        <div class="d-flex align-items-center justify-content-around">

                            <button id="all" class="btn btn-primary me-1">Voir tout</button>
                            <button id="todayButton" class="btn btn-primary me-1">Aujourd'hui</button>
                            <button id="thisWeekButton" class="btn btn-primary filter-btn me-1">Cette semaine</button>
                            <button id="thisMonthButton" class="btn btn-primary filter-btn me-1">Ce Mois</button>
                            <div class="dropdown">
                                <button class="btn btn-primary" type="button" id="dropdownConsultante"
                                    data-toggle="dropdown">
                                    Consultante
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownConsultante">
                                    @foreach (\App\Models\consultante::all() as $consultante)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $consultante->nom }} {{ $consultante->prenoms }}"
                                                id="consultante{{ $consultante->id }}" name="consultante" checked>
                                            <label class="form-check-label" for="consultante{{ $consultante->id }}">
                                                {{ $consultante->nom }} {{ $consultante->prenoms }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="table-responsive p-0" style=" max-height: 700px; min-height: 700px; overflow-y: auto;">
                    <table class="table align-items-center justify-content-center mb-0" id="consultationTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary  text-xxs font-weight-bolder opacity-7">
                                    REJOINDRE
                                </th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                    LABEL
                                </th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                    DATE ET HEURE
                                </th>

                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                    NOMBRE DE CANDIDATS
                                </th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                    CONSULTANTE
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consultations as $consultation)
                                <tr data-candidat-id="{{ $consultation->id }}"
                                    class="{{ $consultation->datePassee ? 'table-danger' : '' }}"
                                    data-date="{{ Carbon\Carbon::parse($consultation->date_heure)->format('Y-m-d') }}">

                                    <td>
                                        <h6 class="p-4 text-md"> <a href="{{ $consultation->lien_zoom }}"
                                                target="_blank">
                                                <i class="material-icons">videocam</i>

                                            </a></h6>
                                    </td>
                                    <td>
                                        <h6 class="p-2 text-center text-md">{{ $consultation->label }}</h6>
                                    </td>
                                    <td>
                                        <p class="text-xl text-bold text-center text-capitalize mb-0">
                                            {{ $consultation->dateFormatee }}
                                        </p>

                                    </td>
                                    <td class="">
                                        <p class="text-xl text-bold text-center mb-0">
                                            {{ $consultation->candidats->count() }} /
                                            {{ $consultation->nombre_candidats }}
                                        </p>

                                    </td>
                                    <td>
                                        <p class="text-xl text-bold text-center  mb-0">
                                            {{ $consultation->consultante->nom . ' ' . $consultation->consultante->prenoms }}
                                        </p>

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection