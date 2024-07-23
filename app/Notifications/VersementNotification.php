<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VersementNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
   
     public $montant;
     public $agent;
    

     public function __construct($montant, $agent)
    {
        $this->montant = $montant;
        $this->agent = $agent;
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
            ->subject('Nouveau paiement')
            ->greeting('Bonjour,')
            ->line('Nouveau paiement de ' . $this->montant . ' FCFA')
            ->line('Enregistré par ' . $this->agent)
            ->salutation('Cordialement');
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
