<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\RessourcesPartage;


class RessourcePartageRefusee extends Notification
{
    use Queueable;
    protected $ressourcesPartage;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(RessourcesPartage $ressourcesPartage)
    {
        $this->ressourcesPartage = $ressourcesPartage;
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
        // Récupération des relations
        $preteur = $this->ressourcesPartage->preteur;
        $emprunteur = $this->ressourcesPartage->emprunteur;
        $ressource = $this->ressourcesPartage->ressource;

        return (new MailMessage)
                    ->subject('Votre demande de ressource a été refusée')
                    ->greeting('Bonjour ' . $emprunteur->nameUser . ',')
                    ->line('Malheureusement votre demande de ressource a été refusée.')
                    ->line('L\'utilisateur ' . $preteur->nameUser . ' a refusé votre demande pour la ressource "' . $ressource->nom . '".')
                    ->line('Quantité demandée : ' . $this->ressourcesPartage->quantite)
                    ->line('Date de partage prévue : ' . $this->ressourcesPartage->date_partage)
                    ->line('Merci d\'utiliser notre plateforme.');
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
