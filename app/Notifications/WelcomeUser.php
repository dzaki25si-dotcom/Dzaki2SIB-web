<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Selamat Datang, ' . $notifiable->name . '!')
        ->greeting('Halo, ' . $notifiable->name . '!')
        ->line('Akun Anda berhasil dibuat pada Sistem Management.')
        ->line('Berikut informasi akun Anda:')
        ->line('Nama: ' . $notifiable->name)
        ->line('Email: ' . $notifiable->email)
        ->line('Silakan login menggunakan alamat email tersebut.')
        ->salutation('Salam, Sistem Management');
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
