<?php

namespace App\Contracts;

interface DeletesNotifications
{
    /**
     * Destroyes given notification.
     *
     * @param string $id
     */
    public function destroy(string $id);
}
