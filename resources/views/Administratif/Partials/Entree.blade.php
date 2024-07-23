
{{-- --}}

<div class="{{ $hasPoste ? 'col-xl-3' : 'col-xl-4' }} col-sm-6 mb-xl-0 mb-4">
    <div class="card">
        <div class="card-header p-3 pt-2 d-flex justify-content-between">
            <div class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4">
                <i class="material-icons opacity-10">account_balance</i>
            </div>
            <p class="text-xl text-bold mb-0 text-capitalize">Caisse - {{$moisEnCours}}</p>

        </div>
        <div class="card-body">
            <div class="text-end">
                
                <h3 class="mb-0 pt-2">{{ $caisse ? number_format($caisse, 0, '.', ' ') : '0' }} {{$devise}}
                </h3>
            </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
           
            
        </div>
        
    </div>
</div>
