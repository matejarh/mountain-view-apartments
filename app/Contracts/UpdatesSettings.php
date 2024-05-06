<?php

namespace App\Contracts;
use App\Models\Setting;

interface UpdatesSettings
{
    /**
     * Validate and updates new setting.
     *
     * @param  array  $input
     * @param  \App\Models\Setting  $setting
     */
    public function update(Setting $setting, array $input);
}
