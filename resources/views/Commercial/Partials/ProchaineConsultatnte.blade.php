              
              <div class="col-lg-4 mt-4 mb-3">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <h6>Prochaines Consultations</h6>
                    </div>
                    <div class="card-body p-3">


                        @foreach (\App\Models\InfoConsultation::latest('date_heure')->take(3)->get() as $consultation)
                            <div class="timeline timeline-one-side">
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                        <a href="{{ $consultation->lien_zoom }}"><i
                                                class="material-icons text-success text-gradient">videocam</i></a>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">
                                            {{ $consultation->consultante->prenoms }}
                                            {{ $consultation->consultante->nom }}
                                        </h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                            {{ $consultation->date_heure }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
