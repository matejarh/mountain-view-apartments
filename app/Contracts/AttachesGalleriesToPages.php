<?php

namespace App\Contracts;
use App\Models\Page;
use App\Models\Gallery;

interface AttachesGalleriesToPages
{
    /**
     * Attaches given gallery to given page.
     *
     * @param  \App\Models\Gallery $gallery
     * @param  \App\Models\Page $page
     */
    public function attach(Gallery $gallery, Page $page);
}
