<?php

namespace App\Contracts;

interface CreatesNewPages
{
    /**
     * Validate and create new page.
     *
     * @param  array  $input
     */
    public function create(array $input);
}
