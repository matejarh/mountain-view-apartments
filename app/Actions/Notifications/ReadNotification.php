<?php

namespace App\Actions\Notifications;

use App\Models\Review;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Contracts\ReadsNotifications;


class ReadNotification implements ReadsNotifications
{
    /**
     * Finds notification with given id and changes read_at fiels to now()
     *
     * @param  string  $in
     */
    public function read(string $id): void
    {
        auth()->user()->unreadNotifications()->find($id)->update(['read_at'=>now()]);

        session()->flash('flash.banner', __('Notification has been read'));
    }
}
