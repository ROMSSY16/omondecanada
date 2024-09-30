<div class="row d-flex flex-direction-column align-items-center justify-content-around">
    {{-- Affiche les entrees du mois --}}
    <div class="row mb-6 mt-4 p-4">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header1 p-3 pt-2 d-flex justify-content-between">
                    <div
                        class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4">
                        <i class="material-icons opacity-10">account_balance_wallet</i>
                    </div>
                    <h3 class="text-xl text-bold mb-0 text-capitalize">CAISSE </h3>

                </div>
                <div class="card-body">
                    <div class="text-end">

                        <h3 class="mb-0 pt-2">{{ number_format($montant_en_caisse_global, 0, '', ' ') }} FCFA</h3>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <div class="progress mt-2">
                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                            style="width: {{ (100 / 100) * 100 }}%; ; height:100%;" aria-valuenow="{{ 40 }}"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                </div>

            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card" data-succursale-id="">
                <div class="card-header1 p-3 pt-2 d-flex justify-content-between">
                    <div
                        class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4">
                        <i class="material-icons opacity-10">arrow_downward</i>
                    </div>
                    <h3 class="text-xl text-bold mb-0 text-capitalize">ENTRÉE</h3>
                </div>
                <div class="card-body">
                    <div class="text-end">
                        <h3 class="mb-0 pt-2">{{ number_format($total_entree_global,0, '', ' ') }} FCFA</h3>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <div class="progress mt-2">
                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                            style="width: {{ (100 / 100) * 100 }}%; ; height:100%;" aria-valuenow="{{ 40 }}"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header1 p-3 pt-2 d-flex justify-content-between">
                    <div
                        class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4">
                        <i class="material-icons opacity-10">arrow_upward</i>
                    </div>
                    <h3 class="text-xl text-bold mb-0 text-capitalize">SORTIES</h3>

                </div>
                <div class="card-body">
                    <div class="text-end">

                        <h3 class="mb-0 pt-2">{{ number_format($total_sortie_global, 0, '', ' ') }} FCFA</h3>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <div class="progress mt-2">
                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                            style="width: {{ (100 / 100) * 100 }}%; ; height:100%;" aria-valuenow="{{ 40 }}"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-12 mt-4 mb-4">
        <div class="card">
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0" style="max-height: 750px; overflow-y: auto;">
                    <table class="table align-items-center justify-content-center mb-0">
                        <thead>
                            <tr class="bg-dark text-white border-radius-xl">
                                <th class="text-uppercase text-lg font-weight-bolder">
                                    SUCCURSALE
                                </th>
                                <th class="text-uppercase text-lg font-weight-bolder ps-2">
                                    TOTAL ENTREES</th>
                                <th class="text-uppercase text-lg font-weight-bolder ps-2">
                                    TOTAL SORTIES</th>
                                <th class="text-uppercase text-lg font-weight-bolder text-center ps-2">
                                    MONTANT EN CAISSE</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
            
                            @foreach ($results as $result)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <h6 class="p-2 text-md">{{ $result['label'] }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-md font-weight-bold mb-0">{{ number_format($result['total_entree'], 0, '', ' ') }} {{ $result['devis'] }}</p>
                                    </td>
                                    <td>
                                        <span class="text-md font-weight-bold">{{ number_format($result['total_sortie'], 0, '', ' ') }} {{ $result['devis'] }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-md font-weight-bold">
                                        {{ number_format($result['montant_en_caisse'], 0, '', ' ') }} {{ $result['devis'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                        
                    </table>
                    
                </div>
                
            </div>
        </div>  
    </div>
    <div class="col-lg-10 col-md-10 mt-4 mb-4">
        <div class="card z-index-2">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-dark shadow-success border-radius-lg py-3 pe-1 text-white">
                    <div class="chart">
                        <canvas id="transactionsChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-0">Courbes des transactions par succursales</h6>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('transactionsChart').getContext('2d');
    const transactionsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($results->pluck('label')) !!}, 
            datasets: [
                {
                    label: 'Entrées',
                    data: {!! json_encode($results->pluck('total_entree')) !!},
                    borderColor: 'green',
                    fill: false
                },
                {
                    label: 'Sorties',
                    data: {!! json_encode($results->pluck('total_sortie')) !!},
                    borderColor: 'red',
                    fill: false
                },
                {
                    label: 'Caisse',
                    data: {!! json_encode($results->pluck('montant_en_caisse')) !!},
                    borderColor: 'blue',
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        color: '#ffffff' 
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#ffffff' 
                    }
                }
            }
        }
    });
</script>

