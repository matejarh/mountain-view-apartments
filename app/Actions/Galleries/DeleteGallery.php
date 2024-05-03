<?php

namespace App\Actions\Galleries;

use App\Contracts\DeletesGalleries;
use App\Models\Gallery;

class DeleteGallery implements DeletesGalleries
{
    /**
     * Deletes given gallery.
     *
     * @param  \App\Models\Gallery  $gallery
     */
    public function destroy(Gallery $gallery): void
    {
        $gallery->delete();

        session()->flash('flash.banner', __('Gallery has been deleted.'));
        session()->flash('flash.bannerStyle', 'danger');
    }
}
