<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;

class AskForWordReview extends Notification implements ShouldBroadcast
{
    use Queueable;

    public string $name;
    public string $avatar;
    public int $word_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $name, string $avatar, $id)
    {
        $this->name    = $name;
        $this->avatar  = $avatar;
        $this->word_id = $id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
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
            ->line('Hello,')
            ->line($this->name . 'Tlab bsh tamlelha review.')
            ->line('El ID mte el kelma ' . $this->word_id);
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'message' => 'ReviewWord',
        ]);
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
            'name'   => $this->name,
            'avatar' => $this->avatar,
            'body'   => 'Asked you to review word ' . $this->word_id,
        ];
    }
}
