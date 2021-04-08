<?php

namespace Lucmas\Reservations\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

/**
 * Class Message
 * @package App\Notifications
 */
class Message extends Notification {
    use Queueable;

    private $title;
    private $type;
    private $text;
    private $sender;

    /**
     * Create a new notification instance.
     *
     * @param array $array
     */
    public function __construct(array $array) {
        $this->title = $array['title'];
        $this->type = $array['type'];
        $this->text = $array['text'];
        $this->sender = $array['sender'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable) {
        if (!isset($this->sender))
            $this->sender = 0;
        return [
            'title' => $this->title,
            'type' => $this->type,
            'text' => $this->text,
            'sender' => $this->sender
        ];
    }
}
