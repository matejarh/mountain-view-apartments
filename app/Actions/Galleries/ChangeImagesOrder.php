<?php

namespace App\Actions\Galleries;

use App\Contracts\ChangesImagesOrder;
use App\Models\Gallery;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\UpdatesGalleries;


class ChangeImagesOrder implements ChangesImagesOrder
{
    /**
     * Validate and update given gallery.
     *
     * @param  \App\Models\Gallery  $gallery
     * @param  array<string, string>  $input
     */
    public function order(Gallery $gallery, array $input): void
    {
        $orderedItemIds = $input['orderedItemIds'];

        // Loop through orderedItemIds and update the order in the database
        foreach ($orderedItemIds as $index => $itemId) {
            $image = $gallery->images->find($itemId);
            $image->pivot->order = $index + 1;
            $image->pivot->save();
        }

        session()->flash('flash.banner', __('Images order has been changed.'));
    }
}
