<div class="row d-flex flex-direction-column align-items-center justify-content-around">
    {{-- Affiche les entrees du mois --}}
    <div class="row mb-6 mt-4 p-4">

        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card" data-succursale-id="">
                <div class="card-header1 p-3 pt-2 d-flex justify-content-between">
                    <div
                        class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4">
                        <i class="material-icons opacity-10">arrow_upward</i>
                    </div>
                    <p class="text-xl text-bold mb-0 text-capitalize">Entree - PAYS</p>
                </div>
                <div class="card-body">
                    <div class="text-end">
                        <h3 class="mb-0 pt-2">montant</h3>
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
                        <i class="material-icons opacity-10">arrow_downward</i>
                    </div>
                    <p class="text-xl text-bold mb-0 text-capitalize">Depenses - Pays</p>

                </div>
                <div class="card-body">
                    <div class="text-end">

                        <h3 class="mb-0 pt-2">MONTANT</h3>
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

        {{-- Affiche la caisse du mois --}}

        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header1 p-3 pt-2 d-flex justify-content-between">
                    <div
                        class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4">
                        <i class="material-icons opacity-10">account_balance_wallet</i>
                    </div>
                    <p class="text-xl text-bold mb-0 text-capitalize">Caisse - Pays</p>

                </div>
                <div class="card-body">
                    <div class="text-end">

                        <h3 class="mb-0 pt-2">MONTANT</h3>
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

        <div class="d-flex flex-row flex-wrap align-items-center justify-content-around mt-4">
            @foreach (App\Models\Succursale::all() as $succursale)
                <div class="form-check mr-3">
                    <input class="form-check-input" type="checkbox" value="{{ $succursale->id }}"
                        id="{{ $succursale->id }}" {{ $succursale->id == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="succursaleCheck{{ $succursale->id }}">
                        {{ $succursale->label }}
                    </label>
                </div>
            @endforeach

        </div>
    </div>
</div>

<div class="col-lg-12 col-md-6 mt-4 mb-4">
<div class="card z-index-2  ">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
        <div class="bg-dark shadow-success border-radius-lg py-3 pe-1">
            <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="350"></canvas>
            </div>
        </div>
    </div>
    <div class="card-body">
        <h6 class="mb-0 ">Coubres Mensuelle des Entrées</h6>
    </div>
</div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        $.get('/Direction/ChartEnsemble', function(data) {
            const monthOrder = [
                "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ];
            const succursaleData = {};
            const colors = [
                "rgba(40, 167, 69, 0.7)", // Vert
                "rgba(255, 255, 255, 1)", // Jaune
                "rgba(220, 53, 69, 0.7)", // Rouge
                "rgba(23, 162, 184, 0.7)", // Turquoise
                
            ];
            data.forEach((entry, index) => {
                if (!succursaleData[entry.succursale]) {
                    succursaleData[entry.succursale] = {
                        label: entry.succursale,
                        data: new Array(12).fill(0), // Initialisez tous les mois à zéro
                        color: colors[index], // Associez la couleur à la succursale
                    };
                }
                succursaleData[entry.succursale].data[monthOrder.indexOf(entry.month)] = entry.totalMontant;
            });

            const datasets = Object.values(succursaleData);

            var ctx2 = document.getElementById("chart-line").getContext("2d");

            new Chart(ctx2, {
                type: "bar",
                data: {
                    labels: monthOrder,
                    datasets: datasets.map(succursale => ({
                        label: succursale.label,
                        backgroundColor: succursale.color,
                        borderColor: succursale.color,
                        borderWidth: 1.5,
                        data: succursale.data,
                    })),
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                color: '#f8f9fa',
                                font: {
                                    size: 12,
                                },
                                usePointStyle: true,
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                display: true,
                                color: '#f8f9fa',
                                padding: 10,
                                stepSize: 1000000,
                                callback: function(value, index, values) {
                                    return value / 1000000 + ' M';
                                },
                                font: {
                                    size: 14,
                                    weight: 400,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 4,
                                },
                            }
                        },
                        x: {
                            ticks: {
                                display: true,
                                color: '#f8f9fa',
                                padding: 10,
                                font: {
                                    size: 14,
                                    weight: 300,
                                    family: "Roboto",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });
        });
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var allData; 

    $(document).ready(function() {
       
        $.ajax({
            url: '/Direction/Dashboard/DataSuccursale', 
            method: 'GET',
            success: function(data) {
                allData = data; 
                updateInterface(data[0]);
            },
            error: function(error) {
                console.log(error);
            }
        });

        $('.form-check-input').change(function() {
            console.log("Checkbox changed");

            var selectedIds = $('.form-check-input:checked').map(function() {
                return $(this).val(); 
            }).get();

            console.log("Selected IDs:", selectedIds);

            var selectedData = allData.filter(function(data) {
                return selectedIds.indexOf(data.id.toString()) !== -
                1; 
            });

            if (selectedData.length === 0) {
                console.log("No checkboxes selected");
               
            } else {
                console.log("Selected data:", selectedData);
                var totalData = {
                    id: '',
                    label: '',
                    totalEntrant: 0,
                    totalDepenses: 0,
                    totalCaisse: 0,
                    devise: 'FCFA', 
                    selectedLabels: selectedData.map(function(succursale) {
                        return succursale.label;
                    }).join(', ')
                };

                selectedData.forEach(function(data) {
                    if (data.devise !== 'FCFA') {
                        data.totalEntrant *= 500; 
                        data.totalDepenses *= 500;
                        data.totalCaisse *= 500;
                    }

                    totalData.totalEntrant += data.totalEntrant;
                    totalData.totalDepenses += data.totalDepenses;
                    totalData.totalCaisse += data.totalCaisse;
                });

                updateInterface(totalData);
            }
        });
    });

    function updateInterface(data) {
        // Mettez à jour l'ID de la succursale
        $('.card[data-succursale-id]').attr('data-succursale-id', data.id);

        // Mettez à jour le label de la succursale
        $('.card-header1 .text-xl').each(function(index) {
            if (index == 0) {
                $(this).text('Entree - ' + data.selectedLabels); // Entrées
            } else if (index == 1) {
                $(this).text('Depenses - ' + data.selectedLabels); // Dépenses
            } else if (index == 2) {
                $(this).text('Caisse - ' + data.selectedLabels); // Caisse
            }
        });

        // Mettez à jour le montant des entrées, dépenses et caisse
        $('.card-body h3').each(function(index) {
            if (index == 0) {
                $(this).text(data.totalEntrant + ' ' + data.devise); // Entrées
            } else if (index == 1) {
                $(this).text(data.totalDepenses + ' ' + data.devise); // Dépenses
            } else if (index == 2) {
                $(this).text(data.totalCaisse + ' ' + data.devise); // Caisse
            }
        });

        $('.progress-bar').each(function(index) {
            var percentage = 0;
            if (index == 0) {
                percentage = (data.totalEntrant / data.totalCaisse) * 100; // Entrées
            } else if (index == 1) {
                percentage = (data.totalDepenses / data.totalEntrant) * 100; // Dépenses
            } else if (index == 2) {
                percentage = (data.totalCaisse / data.totalEntrant) * 100; // Caisse
            }
            $(this).css('width', percentage + '%');
            $(this).attr('aria-valuenow', percentage);
        });
    }
</script>