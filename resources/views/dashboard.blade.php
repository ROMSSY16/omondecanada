@extends('layouts.app')
@section('content')

    @if (auth()->user()->role_as == 'commercial')
        
        <div class="row">
            {{-- Nombre d'appels --}}
            @include('Commercial.Partials.Appels')
            
            {{-- Nombre de visites --}}
            @include('Commercial.Partials.Visites')

            {{-- Nombre de consultations --}}
            @include('Commercial.Partials.Consultations')

            {{-- Nombre de consultations --}}
            @include('Commercial.Partials.Objectifs')


        </div>
        <div class="row mt-4 d-flex justify-content-around">
        
            @include('Commercial.Partials.ChartAppels')

            @include('Commercial.Partials.ChartConsultations')

        </div>

        <div class="row mt-4 mb-3 d-flex justify-content-around">
            
            @include('Commercial.Partials.TableRdv')
        
        </div>
    @endif

@endsection