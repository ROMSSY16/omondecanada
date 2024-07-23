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
