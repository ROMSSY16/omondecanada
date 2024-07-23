
{{-- Affiche du nombre d'appels de la journee --}}

<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
        <div class="card-header1 p-3 pt-2 d-flex justify-content-between">
            <div class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4">
                <i class="material-icons opacity-10">phone</i>
            </div>
            <p class="text-xl text-bold mb-0 text-capitalize">Appels - Aujourd'hui</p>

        </div>
        <div class="card-body">
            <div class="text-end">
                
                <h3 class="mb-0 pt-2">{{ $totalAppelDeCeJour ?? '0' }}</h3>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
            <div class="progress mt-2">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ ($totalAppelDeCeJour / 100) * 100 }}%; ; height:100%;" aria-valuenow="{{ $totalAppelDeCeJour }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            
        </div>
        
    </div>
</div>


<style>
    /* CSS personnalisé pour la carte "Appels - Aujourd'hui" */

    .card {
        border-radius: 10px;
        border: none;
        background-color: #fff;
        box-shadow: 0px 4px 25px rgba(0, 0, 0, 0.1);
        
    }

   

    .card-header1 {
        height:5vw;
        background-color: #f5f5f5;
        border-bottom: 1px solid #e0e0e0;
        padding: 1.5rem 1rem;
        
        
    }

    .icon-shape {
        width: 60px;
        height: 60px;
        display: center;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: #4caf50; /* Couleur verte */
    }

    .icon-shape i {
        font-size: 30px;
        color: #fff; /* Couleur blanche */
    }

    .card-body {
        padding: 1.5rem 1rem;
    }

    .text-bold {
        font-weight: bold;
    }

    .progress {
        height: 10px;
        margin-top: 1rem;
        border-radius: 10px;
    }

    .progress-bar {
        border-radius: 10px;
    }
</style>
