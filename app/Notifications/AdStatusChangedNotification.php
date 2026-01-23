<?php
namespace App\Notifications;

use App\Enums\AdStatus;
use App\Models\Ad;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdStatusChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Ad $ad)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject('Status oglasa: ' . $this->ad->title);

        if ($this->ad->status === AdStatus::Approved) {
            $mail->greeting('Čestitamo!')
                ->line('Vaš oglas "' . $this->ad->title . '" je odobren i sada je vidljiv svim korisnicima.')
                ->action('Pogledaj oglas', url('/ads/' . $this->ad->id))
                ->line('Hvala što koristite našu platformu!');
        } else {
            $mail->greeting('Obavijest o odbijenom oglasu')
                ->line('Nažalost, vaš oglas "' . $this->ad->title . '" nije odobren.')
                ->line('**Razlog:** ' . ($this->ad->rejection_reason ?? 'Nije naveden'))
                ->line('Možete izmijeniti oglas i ponovno ga poslati na pregled.')
                ->action('Uredi oglas', url('/ads/' . $this->ad->id . '/edit'));
        }

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'ad_id'            => $this->ad->id,
            'title'            => $this->ad->title,
            'status'           => $this->ad->status->value,
            'rejection_reason' => $this->ad->rejection_reason,
            'message'          => $this->ad->status === AdStatus::Approved
            ? 'Vaš oglas "' . $this->ad->title . '" je odobren!'
            : 'Vaš oglas "' . $this->ad->title . '" je odbijen.',
            'type'             => 'ad_status_changed',
        ];
    }
}
