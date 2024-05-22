<?php

namespace App\Contracts;

interface DeletesAllNotifications
{
    /**
     * Destroyes all notifications.
     *
     */
    public function destroyAll();
}
