<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\RessourcesPartage;

class RessourcePartageAcceptee extends Notification
{
    use Queueable;
    protected $ressourcePartage;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(RessourcesPartage $ressourcePartage)
    {
        $this->ressourcePartage = $ressourcePartage;
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
        $userPreteur = $this->ressourcePartage->preteur; // prêteur
        $userEmprunteur = $this->ressourcePartage->emprunteur; // emprunteur
        $ressource = $this->ressourcePartage->ressource; // ressource

        return (new MailMessage)
                    ->subject('Demande de ressource acceptée')
                    ->greeting('Bonjour ' . $userEmprunteur->nameUser . ',')
                    ->line('Votre demande de ressource a été acceptée.')
                    ->line('L\'utilisateur ' . $userPreteur->nameUser . ' a accepté votre demande pour la ressource ' . $ressource->nom . '.')
                    ->line('Quantité partagée: ' . $this->ressourcePartage->quantite)
                    ->line('Date de partage: ' . $this->ressourcePartage->date_partage)
                    ->line('Vous pouvez contacter le preteur a travers cette addresse : ' . $userPreteur->email  . '.')
                    ->line('Merci d\'utiliser notre plateforme !');
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
