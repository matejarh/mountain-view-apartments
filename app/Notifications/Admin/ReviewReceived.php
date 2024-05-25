<?php

namespace App\Notifications\Admin;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReviewReceived extends Notification
{
    use Queueable;

    public $review;
    /**
     * Create a new notification instance.
     */
    public function __construct(Review $review)
    {
        $this->review = $review;
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
        ->subject(__('New review received'))
        ->markdown('mail.admin.review.received', ['review' => $this->review, 'lang' => app()->currentLocale()]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New Review Received',
            'message' => 'New review for ' . $this->review->reviewed_trimed[0]['title']->{app()->currentLocale()} . ' received',
            'link' => route('admin.reviews.show', $this->review),
            'icon' => 'PenNibIcon',
        ];
    }
}
