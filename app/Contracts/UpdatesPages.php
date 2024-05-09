<?php

namespace App\Contracts;

use App\Models\Page;

interface UpdatesPages
{
    /**
     * Validate and updates new page.
     *
     * @param  array  $input
     * @param  \App\Models\Page $page
     */
    public function update(Page $page, array $input);
}
