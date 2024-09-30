<h2 class="title mb-4 text-end">Mois en cours : <span class="text-primary">{{ $moisActuel }}</span></h2>
<div class="row mt-4 d-flex justify-content-around">
   
    {{-- Nombre d'appels --}}
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header1 p-3 pt-2 d-flex justify-content-between">
                <div class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4">
                    <i class="material-icons opacity-10">phone</i>
                </div>
                <h3 class="text-xl text-bold mb-0 text-capitalize">PROSPECTS</h3>

            </div>
            <div class="card-body">
                <div class="text-end">
                    
                    <h3 class="mb-0 pt-2">{{ $candidatesCount ?? '0' }}</h3>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <div class="progress mt-2">
                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ ($candidatesCount / 100) * 100 }}%; ; height:100%;" aria-valuenow="{{ $candidatesCount }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                
            </div>
            
        </div>
    </div>
    {{-- Nombre de visites --}}
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header1 p-3 pt-2 d-flex justify-content-between">
                <div class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4 ">
                    <i class="material-icons opacity-10">groups</i>
                </div>
                <h3 class="text-xl text-bold mb-0 text-capitalize">RENDEZ-VOUS </h3>
                
            </div>
            
            <div class="card-body">
                <div class="text-end">
                    <h3 class="mb-0 pt-2">{{ $rendezvousCount ?? '0' }}</h3>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                {{-- Barre de progression --}}
                <div class="progress mt-2">
                    <div class="progress-bar progress-bar-striped bg-dark" role="progressbar" style="width: {{ ($rendezvousCount / 25) * 100 }}%; ; height:100%;"" aria-valuenow="{{ $rendezvousCount }}" aria-valuemin="0" aria-valuemax="25"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- Nombre de consultations --}}
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header1 p-3 pt-2 d-flex justify-content-between">
                <div class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4">
                    <i class="material-icons opacity-10">handshake</i>
                </div>
                <h3 class="text-xl text-bold mb-0 text-capitalize">CONSULTATIONS </h3>

            </div>
            <div class="card-body">
                <div class="text-end">
                    
                    <h3 class="mb-0 pt-2">{{  $consultationsCount ?? '0' }}</h3>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <div class="progress mt-2">
                    <div class="progress-bar progress-bar bg-dark" role="progressbar" style="width: {{ ($consultationsCount / 25) * 100 }}%; height:100%;" aria-valuenow="{{$consultationsCount }}" aria-valuemin="0" aria-valuemax="25"></div>
                </div>
                
                
            </div>
            
        </div>
    </div>
    {{-- Nombre de consultations --}}
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header1 p-3 pt-2 d-flex justify-content-between">
                <div class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4">
                    <i class="material-icons opacity-10">trending_up</i>
                </div>
                <h3 class="text-xl text-bold mb-0 text-capitalize">OBJECTIFS</h3>
            </div>
            <div class="row card-body">
                <div class="col-4 text-center ">
                    <i class="material-icons text-bold text-success ">phone</i>
                    <h5 class="text-bold">{{$candidatesCount}}/100</h5>
                </div>
                <div class="col-4 text-center">
                    <i class="material-icons text-bold text-success ">groups</i>
                    <h5 class="text-bold">{{$rendezvousCount}}/25</h5>
                </div>
                <div class="col-4 text-center">
                    <i class="material-icons text-bold text-success ">handshake</i>
                    <h5 class="text-bold">{{$consultationsCount}}/25</h5>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
            </div>
            
        </div>
    </div>
</div>
<div class="row mt-4 d-flex justify-content-around">
    <div class="col-lg-5 col-md-6 mt-4 mb-4">
        <div class="card z-index-2">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-dark shadow-primary border-radius-lg py-3 pe-1">
                    <div class="chart">
                        <canvas id="prospectsChart" class="chart-canvas" height="200px"></canvas>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-0">Courbe des prospects du mois</h6>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-md-6 mt-4 mb-4">
        <div class="card z-index-2">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-dark shadow-success border-radius-lg py-3 pe-1">
                    <div class="chart">
                        <canvas id="consultationsChart" class="chart-canvas" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-0">Consultations Conclues du mois</h6>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4 mb-3 d-flex justify-content-around">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3">
                <div class="bg-gradient-dark shadow-primary border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                    <div class="p-2 border-radius-lg w-100 d-flex flex-direction-row justify-content-between ">
                        <h3 class="text-white">
                            Rendez-vous du jour
                        </h3>

                        <a href="{{ route('rendezvous.index') }}" class="btn btn-primary">
                            Voir tout
                        </a>
                    </div>
                </div>

                <div class="card-body px-0 pb-2 ">
                    <div class="table-responsive p-0" style="max-height: 750px; overflow-y: auto;">
                        <table class="table align-items-center justify-content-between mb-0 bg-white">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-left text-secondary text-xxs font-weight-bolder opacity-7">
                                        NOM
                                    </th>
                                    <th
                                        class="text-uppercase  text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NUMERO
                                    </th>
                                    <th
                                        class="text-uppercase  text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        PROFFESSION
                                    </th>

                                    <th
                                        class="text-uppercase  text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        DATE DE RDV
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rendezVous as $candidat)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <h6 class="p-2 text-md">{{ $candidat->nom }} {{ $candidat->prenom }}
                                                </h6>
                                            </div>
                                        </td>

                                        <td>
                                            <p class="text-md font-weight-bold mb-0">{{ $candidat->numero_telephone }}
                                            </p>
                                        </td>

                                        <td>
                                            <span class="text-md font-weight-bold">{{ $candidat->profession }}</span>
                                        </td>
                                        <td>
                                            @php
                                                $carbonDate = \Carbon\Carbon::parse($candidat->date_rdv);
                                                $formattedDate = ucwords($carbonDate->translatedFormat('l j F Y'));
                                            @endphp
                                            <span class="text-md font-weight-bold">{{ $formattedDate ?? 'Pas de rdv' }}</span>
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
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data for prospects chart
    var prospectsCtx = document.getElementById('prospectsChart').getContext('2d');
    var prospectsChart = new Chart(prospectsCtx, {
        type: 'bar', // Bar chart for prospects
        data: {
            labels: @json($days),
            datasets: [{
                label: 'Prospects',
                data: @json($prospectsData),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Data for consultations chart
    var consultationsCtx = document.getElementById('consultationsChart').getContext('2d');
    var consultationsChart = new Chart(consultationsCtx, {
        type: 'line', // Line chart for consultations
        data: {
            labels: @json($days),
            datasets: [{
                label: 'Consultations Conclues',
                data: @json($consultationsData),
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>