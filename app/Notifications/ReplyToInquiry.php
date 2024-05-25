<?php

namespace App\Notifications;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReplyToInquiry extends Notification implements ShouldQueue
{
    use Queueable;


    public $reply;
    public $inquiry;
    /**
     * Create a new notification instance.
     */
    public function __construct($reply, Inquiry $inquiry)
    {
        $this->reply = $reply;
        $this->inquiry = $inquiry;
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
            ->theme('mountain')
            ->subject($this->reply['subject'])
            ->markdown('mail.inquiry.reply', ['inquiry' => $this->inquiry, 'reply' => $this->reply, 'lang' => app()->currentLocale()])
            /* ->line(strip_tags($this->reply['text']))
            ->action('Notification Action', url('/'))
            ->line('Thank you for using ' . config('app.name') . '!') */;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Reply To your Inquiry',
            'message' => $this->reply['text'],
            'link' => route('inquiries.show', $this->inquiry)
        ];
    }
}
