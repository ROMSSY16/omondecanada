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

        // Créez un objet pour stocker les données par succursale
        const succursaleData = {};

        // Liste de couleurs pour chaque succursale
        const colors = [
    "rgba(40, 167, 69, 0.7)", // Vert
    "rgba(255, 255, 255, 1)", // Jaune
    "rgba(220, 53, 69, 0.7)", // Rouge
    "rgba(23, 162, 184, 0.7)", // Turquoise
    
];

        // Organisez les données par succursale
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

        // Convertissez l'objet en un tableau d'objets
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
