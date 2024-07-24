@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            {{-- Total caisse --}}
            @include('Administratif.Partials.Caisse')
            
            {{-- Nombre de COnsultation --}}
            @include('Administratif.Partials.Consultation')
            
            
            {{-- Nombre de versements--}}
            @include('Administratif.Partials.Versement')

            @if ($hasPoste)

            @include('Administratif.Partials.Entree')

            @endif

        </div>
        <div class="row d-flex justify-content-between flex-direction-column">
            
                @include('Administratif.Partials.ChartEntree')               
            
                @include('Administratif.Partials.ProchaineConsultation')
        </div>          
    </div>
@endsection