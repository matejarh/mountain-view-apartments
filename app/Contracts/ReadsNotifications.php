<?php

namespace App\Contracts;

interface ReadsNotifications
{
    /**
     * Reads given notification.
     *
     * @param string $id
     */
    public function read(string $id);
}
