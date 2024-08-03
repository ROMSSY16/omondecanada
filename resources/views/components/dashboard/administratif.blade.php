
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2 d-flex justify-content-between">
                <div class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4">
                    <i class="material-icons opacity-10">wallet</i>
                </div>
                <p class="text-xl text-bold mb-0 text-capitalize">Entrées - {{$moisEnCours}}</p>

            </div>
            <div class="card-body">
                <div class="text-end">
                    <h3 class="mb-0 pt-2">{{ $entreeMensuel ? number_format($entreeMensuel, 0, '.', ' ') : '0' }} {{$devise}}
                    </h3>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <div class="progress mt-2">
                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ ($entreeMensuel/1000000)*100 }}%; height:100%;" aria-valuemin="0" aria-valuemax="1000000"></div>
                </div>
                
            </div>
            
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2 d-flex justify-content-between">
                <div class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4">
                    <i class="material-icons opacity-10">handshake</i>
                </div>
                <p class="text-xl text-bold mb-0 text-capitalize">Consultations - {{$moisEnCours}}</p>

            </div>
            <div class="card-body">
                <div class="text-end">
                    
                    <h3 class="mb-0 pt-2">{{ $nombreConsultationMensuel ?? '0' }} </h3>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <div class="progress mt-2">
                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ ($nombreConsultationMensuel / 25) * 100 }}%; height:100%;" aria-valuemin="0" aria-valuemax="25"></div>
                </div>
                
            </div>
            
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-header p-3 pt-2 d-flex justify-content-between">
                <div class="icon icon-md icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4">
                    <i class="material-icons opacity-10">payments</i>
                </div>
                <p class="text-xl text-bold mb-0 text-capitalize">Versements - {{$moisEnCours}}</p>

            </div>
            <div class="card-body">
                <div class="text-end">
                    
                    <h3 class="mb-0 pt-2">{{ $nombreVersementMensuel ?? '0' }} </h3>
                </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <div class="progress mt-2">
                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ ($nombreVersementMensuel / 10) * 100 }}%; height:100%;" aria-valuemin="0" aria-valuemax="10"></div>
                </div>
                
            </div>
            
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
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
</div>
<div class="row d-flex justify-content-between flex-direction-column">
    <div class="col-lg-6 col-md-12 mt-6 mb-6">
        <div class="card">
            <div class="card-header p-0 position-relative mt-n4 mx-3 bg-transparent">
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
    <div class="col-lg-6 col-md-12 mt-4 mb-3">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center">
                <h3 >Prochaines Consultations</h3>
            </div>
            <div class="card-body p-3 p-4">
                @foreach ($consultations as $consultation)
                    <div class="timeline timeline-one-side">
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <a href="{{ $consultation->lien_zoom }}">
                                    <i
                                        class="material-icons {{ today()->isSameDay($consultation->date_heure) ? 'text-danger' : 'text-success' }}">videocam</i>
                                </a>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-xl font-weight-bold mb-0">
                                    {{ $consultation->consultante->prenoms }} {{ $consultation->consultante->nom }}
                                </h6>
                                <p class="text-secondary font-weight-bold text-md mt-1 mb-0">
                                    {{ $consultation->dateFormatee }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    
        </div>
    </div>
</div>
