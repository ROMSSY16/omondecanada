<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StatutNotifications extends Notification
{
    use Queueable;

    private $statutLabel;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($statutLabel)
    {
        $this->statutLabel = $statutLabel;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Avancement dans votre procedure d\'immigration')
                    ->greeting('Bonjour,')
                    ->line('Nous avons le plaisir de vous annoncer l\'avancement dans votre procdure')
                    ->line('En effet vous etes maintenant à l\'etape de "' . $this->statutLabel . '"')
                    ->line('Vous pouvez contacter votre agent de suivi pour plus d\'information ,' )
                    ->salutation('Cordialement.');
    }
}
