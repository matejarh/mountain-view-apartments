<?php

namespace App\Actions\Pages;

use App\Contracts\DetachesGalleriesFromPages;
use App\Models\Gallery;
use App\Models\Page;

class DetachGallery implements DetachesGalleriesFromPages
{
    /**
     * Attaches given page to given gallery.
     *
     * @param  \App\Models\Page  $page
     * @param  \App\Models\Gallery  $gallery
     */
    public function detach( Gallery $gallery, Page $page): void
    {
        $page->galleries()->detach($gallery);

        session()->flash('flash.banner', __('Gallery has been detached from the page.'));
    }
}
