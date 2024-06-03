<?php

namespace App\Contracts;

interface UpdatesTranslations
{
    /**
     * Validate and updates translations.
     *
     * @param  array  $input
     */
    public function update(array $input);
}
