<?php

namespace App\Actions\Notifications;

use App\Models\Review;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Contracts\ReadsAllNotifications;


class ReadAllNotifications implements ReadsAllNotifications
{
    /**
     * Changes read_at fiels to now() to all unread notidivations
     *
     */
    public function readAll(): void
    {
        auth()->user()->unreadNotifications()->update(['read_at'=>now()]);

        session()->flash('flash.banner', __('All unread notifications has been read'));
    }
}
