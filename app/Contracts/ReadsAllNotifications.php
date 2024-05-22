<?php

namespace App\Contracts;


interface ReadsAllNotifications
{
    /**
     * Reads all notifications auth()->user().
     *
     */
    public function readAll();
}
