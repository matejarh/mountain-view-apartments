<?php

namespace App\Contracts;
use App\Models\Page;

interface DeletesPages
{
    /**
     * Destroyes given image.
     *
     * @param  \App\Models\Page $page
     */
    public function destroy(Page $page);
}
