<?php

namespace App\Actions\Images;

use App\Models\Image;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\DeletesImages;


class DeleteImage implements DeletesImages
{
    /**
     * Deletes given image.
     *
     * @param  \App\Models\Image  $image
     */
    public function destroy(Image $image): void
    {
        $image->deletePhoto();
        $image->deleteThumb();
        $image->deleteTile();
        $image->delete();

        session()->flash('flash.banner', __('Image and all its files and thumbnails has been deleted.'));
        session()->flash('flash.bannerStyle', 'danger');
    }
}
