<?php

namespace App\Mail;

use App\Models\InfoConsultation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class ConsultationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $consultation;
    public $action;

    public function __construct(InfoConsultation $consultation, $action)
    {
        $this->consultation = $consultation;
        $this->action = $action;
    }

    public function build()
    {
        $date = Carbon::parse($this->consultation->date_heure)->translatedFormat('l, j F Y \à H:i');

        return $this->view('emails.consultation')
                    ->subject('Mise à jour de la consultation')
                    ->with([
                        'action' => $this->action,
                        'lien_zoom' => $this->consultation->lien_zoom,
                        'lien_zoom_demarrer' => $this->consultation->lien_zoom_demarrer,
                        'date' => $date . ' (Heure du Canada)',
                        'nombre_candidats' => $this->consultation->nombre_candidats,
                        'consultante' => $this->consultation->consultante->nom . ' ' . $this->consultation->consultante->prenoms,
                    ]);
    }
}
