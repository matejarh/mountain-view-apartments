<?php

namespace App\Notifications\Admin;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationReceived extends Notification implements ShouldQueue
{
    use Queueable;

    public $reservation;
    /**
     * Create a new notification instance.
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
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
            ->subject('New reservation for ' . $this->reservation->property->name)
            ->markdown('mail.admin.reservation.received', ['reservation' => $this->reservation, 'lang' => app()->currentLocale()]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New Reservation Received',
            'message' => 'New reservation for ' . $this->reservation->property->name . ' received',
            'link' => route('admin.reservations.show', $this->reservation),
            'icon' => 'NewReservationIcon',
        ];
    }
}
