<?php
namespace App\Notifications;

use App\Models\Ad;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAdSubmittedNotification extends Notification implements ShouldQueue
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
        return (new MailMessage)
            ->subject('Novi oglas čeka odobrenje: ' . $this->ad->title)
            ->greeting('Pozdrav!')
            ->line('Korisnik ' . $this->ad->user->firstname . ' ' . $this->ad->user->lastname . ' je objavio novi oglas.')
            ->line('**Naslov:** ' . $this->ad->title)
            ->line('**Kategorija:** ' . $this->ad->category)
            ->line('**Tip:** ' . ($this->ad->type === 'offer' ? 'Ponuda' : 'Potražnja'))
            ->action('Pregledaj oglas', url('/admin/ads/' . $this->ad->id))
            ->line('Molimo pregledajte oglas i odobrite ili odbijte objavu.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'ad_id'   => $this->ad->id,
            'title'   => $this->ad->title,
            'user_id' => $this->ad->user_id,
            'message' => 'Novi oglas čeka odobrenje: ' . $this->ad->title,
            'type'    => 'new_ad_submitted',
        ];
    }
}
