@extends('layouts.app')
@section('content')
    @php
        use Carbon\Carbon;
        use Illuminate\Support\Facades\Auth;
        use App\Models\Consultante;
        use App\Models\InfoConsultation;
        
        setlocale(LC_TIME, 'fr_FR.utf8'); // Définir la localisation en français
        $moisActuel = ucfirst(Carbon::now()->formatLocalized('%B'));
    @endphp

    @role('direction')
        @include('components.dashboard.direction')
    @endrole

    @role('consultante')
        @include('components.dashboard.consultante')
    @endrole

    @role('commercial')
        @include('components.dashboard.commercial')
    @endrole

    @role('administratif')
        @include('components.dashboard.administratif')
    @endrole

    @role('informaticien')
    @endrole
@endsection
