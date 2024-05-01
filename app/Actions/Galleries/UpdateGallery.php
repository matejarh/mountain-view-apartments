<?php

namespace App\Actions\Galleries;

use App\Models\Gallery;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\UpdatesGalleries;


class UpdateGallery implements UpdatesGalleries
{
    /**
     * Validate and update given gallery.
     *
     * @param  \App\Models\Gallery  $gallery
     * @param  array<string, string>  $input
     */
    public function update(Gallery $gallery, array $input): void
    {
        $attributeNames = array(
            'name' => __('Name'),
            'description' => __('Description'),
        );

        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255', new SpamFree],
            'description' => ['nullable', 'string', new SpamFree],
        ]);

        $validator->setAttributeNames($attributeNames)->validate();

        $gallery->forceFill([
            'name' => $input['name'],
            'description' => $input['description'],
        ])->save();
    }
}
