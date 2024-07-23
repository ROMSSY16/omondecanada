<td class="align-middle text-center">
    @if ($candidat->consultation_payee && !$candidat->consultation_effectuee)
        <div class="btn-group">
            <button class="btn btn-success dropdown-toggle" type="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="material-icons">add</i>
            </button>
            <div class="dropdown-menu" id="dropdownMenu" data-candidat-id="{{ $candidat->id }}">
                @php
                    $prochainesConsultations = App\Models\InfoConsultation::whereDate('date_heure', '>', now())
                        ->take(3)
                        ->get();

                    foreach ($prochainesConsultations as $consultation) {
                        $dateHeure = \Carbon\Carbon::parse($consultation['date_heure']);
                        $formattedDateHeure = $dateHeure->format('d M Y H:i');
                        echo '<a class="dropdown-item consultation-link" href="#" data-consultation-id="' . $consultation->id . '">' . $consultation['label'] . ' - ' . $formattedDateHeure . '</a>';
                    }
                @endphp
            </div>
        </div>
    @else
        @if ($candidat->consultation_payee && $candidat->consultation_effectuee && $candidat->infoConsultation)
       
            <h6 class="p-2 text-md">{{ $candidat->infoConsultation->label }}</h6>

        @endif
    @endif
</td>
