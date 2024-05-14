<?php

namespace App\Actions\Galleries;

use App\Contracts\AttachesGalleriesToImages;
use App\Contracts\AttachesImagesToGalleries;
use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AttachToImage implements AttachesImagesToGalleries
{
    /**
     * Attaches given gallery to given image.
     *
     * @param  \App\Models\Gallery  $gallery
     * @param  \App\Models\Image  $image
     */
    public function attach(Image $image, Gallery $gallery): void
    {
        $input = [
            'gallery_id' => $gallery->id,
            'image_id' => $image->id,
        ];

        $attributeNames = array(
            'gallery_id' => __('Gallery'),
            'image_id' => __('Image'),
        );

        $validator = Validator::make($input, [
            'gallery_id' => ['required', Rule::unique('galleries_images')->where(function ($query) use($input) {
                                            return $query->where('gallery_id', $input['gallery_id'])
                                                        ->where('image_id', $input['image_id']);
                                        })],
            'image_id' => ['nullable', Rule::unique('galleries_images')->where(function ($query) use($input) {
                                                return $query->where('gallery_id', $input['gallery_id'])
                                                            ->where('image_id', $input['image_id']);
                                            })],
                                        ],[
        ]);

        $validator->setAttributeNames($attributeNames)->validateWithBag('attachingToImage');

        $gallery->images()->attach($image, ['order' => $gallery->images->count() + 1]);

        session()->flash('flash.banner', __('Image has been attached to the gallery.'));
    }
}
