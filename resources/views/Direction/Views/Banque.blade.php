@extends('layouts.app')
@section('content')
        @php
            use Carbon\Carbon;
            setlocale(LC_TIME, 'fr_FR.utf8'); // Définir la localisation en français
            $moisActuel = ucfirst(Carbon::now()->formatLocalized('%B'));
        @endphp

        @include('Direction.Partials.TableauSuccursale')
   @endsection