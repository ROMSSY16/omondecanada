<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\InfoConsultation;

class ConsultationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $consultation;
    protected $action;

    public function __construct(InfoConsultation $consultation, $action)
    {
        $this->consultation = $consultation;
        $this->action = $action;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('La consultation a été ' . $this->action . '.')
                    ->line('Lien Zoom: ' . $this->consultation->lien_zoom)
                    ->line('Lien Zoom démarrer: ' . $this->consultation->lien_zoom_demarrer)
                    ->line('Date et Heure: ' . $this->consultation->date_heure . 'Heure du Canada')
                    ->line('Nombre de participants: ' . $this->consultation->nombre_candidats)
                    ->line('Consultante: ' . $this->consultation->consultante->nom . ' ' . $this->consultation->consultante->prenoms);
    }

    public function toArray($notifiable)
    {
        return [
            'consultation_id' => $this->consultation->id,
            'action' => $this->action,
        ];
    }
}
