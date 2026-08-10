<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class AdminCreateUserNotification extends Notification
{
    use Queueable;
    protected $password;
    /**
     * Create a new notification instance.
     */
    public function __construct($password)
    {
        $this->password = $password;
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
        $verificationUrl = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(60),
                ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
            );
            return (new MailMessage)
                    ->subject('Aktivasi Akun E-Learning Abed')
                    ->greeting('Halo, ' . $notifiable->name . '!')
                    ->line('Akun Anda telah didaftarkan oleh Admin.')
                    ->line('Berikut adalah detail login sementara Anda:')
                    ->line('Username: ' . $notifiable->username)
                    ->line('Password: ' . $this->password)
                    ->action('Verifikasi Akun', $verificationUrl)
                    ->line('Harap segera ganti password Anda setelah login demi keamanan.')
                    ->line('Terima kasih telah menggunakan aplikasi kami!');
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
