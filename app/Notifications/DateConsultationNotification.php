<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DateConsultationNotification extends Notification
{
    use Queueable;

    public $nom;
    public $prenom;
    public $firstTime;
    public $dateConsultation;
    public $heureConsultation;
    public $lienZoom;
    
    public function __construct($nom, $prenom, $firstTime, $dateConsultation, $heureConsultation ,$lienZoom)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->firstTime = $firstTime;
        $this->dateConsultation = $dateConsultation;
        $this->heureConsultation = $heureConsultation;
        $this->lienZoom = $lienZoom;
    }
    
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */

     public function toMail($notifiable)
     {
         $mailMessage = new MailMessage;
     
         if ($this->firstTime) {
             $mailMessage->subject('PROGRAMMATION DE VOTRE DATE DE CONSULTATION');
         } else {
             $mailMessage->subject('REPROGRAMMATION DE VOTRE DATE DE CONSULTATION');
         }
     
         $mailMessage->greeting('Bonjour, M./Mme ' . $this->nom ." ". $this->prenom)
             ->line('Nous avons le plaisir de vous annoncer le debut dans votre procedure d\'immigration au canada');
     
         if ($this->firstTime) {
             $mailMessage->line('Votre consultation est fixée pour le ' . $this->dateConsultation . ' à ' . $this->heureConsultation . '(Heure du Canada)');
         } else {
             $mailMessage->line('Votre consultation a été reprogrammée pour le ' . $this->dateConsultation . ' à ' . $this->heureConsultation . '(Heure du Canada)');
         }
     
         $mailMessage->line('Cliquer sur ce lien pour vous connecter a la consultation:')
         ->action('Accéder à la consultation', $this->lienZoom)
        ->line('Vous pouvez contacter votre agent de suivi pour plus d\'information ,')
             ->salutation('Au plaisir de vous faire sentir partout au monde comme chez vous !');
     
            
         return $mailMessage;
     }
     

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}