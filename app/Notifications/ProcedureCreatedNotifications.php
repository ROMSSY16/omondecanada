<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProcedureCreatedNotifications extends Notification
{
    use Queueable;

    public $nom;
    public $prenom;

    
    public function __construct( $nom, $prenom)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
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
        return (new MailMessage)
                    ->subject('Debut dans votre procedure d\'immigration')
                    ->greeting('Bonjour, M./Mme '  . $this->nom ." ". $this->prenom)
                    ->line('Nous avons le plaisir de vous annoncer le debut dans votre procedure d\'immigration au canada')
                    ->line('Vous pouvez contacter votre agent de suivi pour plus d\'information ,' )
                    ->salutation('Au plaisir de vous faire sentir partout au monde comme chez vous !');
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
