<?php

namespace App\Contracts;
use App\Models\Page;
use App\Models\Gallery;

interface DetachesGalleriesFromPages
{
    /**
     * Detaches given gallery to given page.
     *
     * @param  \App\Models\Gallery $gallery
     * @param  \App\Models\Page $page
     */
    public function detach(Gallery $gallery, Page $page);
}
