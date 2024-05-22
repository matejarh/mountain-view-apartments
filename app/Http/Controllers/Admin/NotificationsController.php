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
use App\Models\Notification;
use Illuminate\Http\Request;
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
        $destroyer->destroyAll();

        return app(NotificationDeleteAllResponse::class);
    }
}
