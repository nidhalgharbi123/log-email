<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TwoFactorCode extends Notification
{
    // protected $user;
    // protected $code;

    // public function __construct(User $user, $code)
    // {
    //     $this->user = $user;
    //     $this->code = $code;
    // }

    public function via($notifiable)
    {
        return ['mail'];
    }
 /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toMail($notifiable)
    {
        
        return (new MailMessage)
            ->line('Votre code à deux facteurs est : ' . $notifiable->two_factor_code)
            ->line('Ce code expirera dans 10 minutes.')
            ->action('Vérifier le code',route('auth.verify'));
    }

    
}
