<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\DeletesAllNotifications;
use App\Contracts\DeletesNotifications;
use App\Contracts\NotificationDeleteAllResponse;
use App\Contracts\NotificationDeleteResponse;
use App\Contracts\NotificationReadAllResponse;
use App\Contracts\NotificationReadResponse;
use App\Contracts\ReadsAllNotifications;
use App\Contracts\ReadsNotifications;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Notification;
use App\Models\Property;
use App\Models\User;
use App\Notifications\Admin\ReservationReceived;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;

class NotificationsController extends Controller
{
    /**
     * Read notification with given id for auth()->user().
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\ReadsNotifications  $reader
     * @return \App\Contracts\NotificationReadResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function read(Request $request, ReadsNotifications $reader): NotificationReadResponse
    {
        Gate::authorize('update', Notification::find($request->only('id')['id']));

        $reader->read($request->only('id')['id']);

        return app(NotificationReadResponse::class);
    }

    /**
     * Reads all notifications for auth user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\ReadsAllNotifications  $reader
     * @return \App\Contracts\NotificationReadAllResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function readAll(Request $request, ReadsAllNotifications $reader): NotificationReadAllResponse
    {
        Gate::authorize('update', Notification::class);

        $reader->readAll();

        return app(NotificationReadAllResponse::class);
    }

    /**
     * Destroyes auth users notification with given id.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\DeletesNotifications  $destroyer
     * @return \App\Contracts\NotificationReadAllResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, DeletesNotifications $destroyer): NotificationDeleteResponse
    {
        Gate::authorize('delete', Notification::find($request->only('id')['id']));

        $destroyer->destroy($request->only('id')['id']);

        return app(NotificationDeleteResponse::class);
    }

    /**
     * Destroyes all auth users notifications.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\DeletesAllNotifications  $destroyer
     * @return \App\Contracts\NotificationReadAllResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroyAll(Request $request, DeletesAllNotifications $destroyer): NotificationDeleteAllResponse
    {
        Gate::authorize('update', Notification::class);
        $destroyer->destroyAll();

        return app(NotificationDeleteAllResponse::class);
    }

    /** Previews notificaition with given attributes
     *
     */
    public function preview(Request $request, $notification, $items): MailMessage
    {
        Gate::authorize('viewAny', Notification::class);
        if ($notification === 'ReplyToInquiry') {
            $notificationClass = "\\App\\Notifications\\" . ucfirst($notification);

            if (!class_exists($notificationClass)) {
                abort(404, 'Notification class not found.');
            }
            $inquiry = Inquiry::first();
            $reply = [
                'text' => "<p>".fake()->sentence()." <b>tole je pa bold</b></p>",
                'subject'=> __("Reply to your inquiry about") . $inquiry->property->title->en,
            ];
            return (new $notificationClass($reply, $inquiry))
            ->toMail(User::adminsMailingList());
        }
        $notificationClass = "\\App\\Notifications\\Admin\\" . ucfirst($notification);
        //$itemsClass = "\\App\\Model\\" . ucfirst($items);

        if (!class_exists($notificationClass)) {
            abort(404, 'Notification class not found.');
        }

        $property = Property::with($items)->findOrFail(1);

        $i = $property->$items->count() > 0 ? $property->$items[0] : abort(404, "No $items found");

        return (new $notificationClass($i))
            ->toMail(User::adminsMailingList());
    }
}
