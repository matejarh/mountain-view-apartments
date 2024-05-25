<?php

namespace App\Notifications\Admin;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InquiryReceivedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $inquiry;
    /**
     * Create a new notification instance.
     */
    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
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
                    ->theme('mountain')
                    ->subject(__('New inquiry received'))
                    ->markdown('mail.admin.inquiry.received', ['inquiry' => $this->inquiry, 'lang' => app()->currentLocale()])
/*                     ->line('New inquiry from ' . $this->inquiry->name . '')
                    ->line('for ' . $this->inquiry->property->name . ' received.')
                    ->action('Show', route('admin.inquiries.show', $this->inquiry))
                    ->line('Thank you for using '.config('app.name').'!') */;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New Inquiry Received',
            'message' => 'New inquiry for ' . $this->inquiry->property->name . ' received',
            'link' => route('admin.inquiries.show', $this->inquiry),
            'icon' => 'NewInquiryIcon',
        ];
    }
}
