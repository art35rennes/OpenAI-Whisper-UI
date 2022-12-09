<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WhisperNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['web'];
    }

    /**
     * @param $notifiable
     * @return mixed
     */
    public function toWeb($notifiable){
        return (new BroadcastMessage)->title("Whisper transcription has ended.")->data(["url" => url('/results')]);
    }

    public function toArray($notifiable){
        return [
            'title' => "Whisper transcription has ended",
            'data' => ["url" => url('/results')]
        ];
    }
}
