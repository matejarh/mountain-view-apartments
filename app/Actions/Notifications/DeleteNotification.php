<?php

namespace App\Actions\Notifications;

use App\Models\Review;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Contracts\DeletesNotifications;


class DeleteNotification implements DeletesNotifications
{
    /**
     * Finds notification with given id and deletes it
     *
     * @param  string  $id
     */
    public function destroy(string $id): void
    {
        auth()->user()->notifications()->find($id)->delete();

        session()->flash('flash.banner', __('Notification has been deleted'));
        session()->flash('flash.bannerStyle', 'danger');
    }
}
