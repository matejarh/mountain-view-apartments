<?php

namespace App\Actions\Notifications;

use App\Models\Review;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Contracts\DeletesAllNotifications;


class DeleteAllNotifications implements DeletesAllNotifications
{
    /**
     * Changes read_at fiels to now() to all unread notidivations
     *
     */
    public function destroyAll(): void
    {
        auth()->user()->notifications()->delete();

        session()->flash('flash.banner', __('All unread notifications has been deleted'));
        session()->flash('flash.bannerStyle', 'danger');
    }
}
