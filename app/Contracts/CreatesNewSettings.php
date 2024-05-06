<?php

namespace App\Contracts;

interface CreatesNewSettings
{
    /**
     * Validate and create new setting.
     *
     * @param  array  $input
     */
    public function create(array $input);
}
