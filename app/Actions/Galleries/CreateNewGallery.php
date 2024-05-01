<?php

namespace App\Actions\Galleries;

use App\Models\Gallery;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\CreatesNewGalleries;


class CreateNewGallery implements CreatesNewGalleries
{
    /**
     * Validate and create new gallery.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input)
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

        Gallery::forceCreate([
            'user_id' => auth()->id(),
            'name' => $input['name'],
            'slug' => str($input['name'])->slug(),
            'description' => isset($input['description']) ? $input['description'] : null,
        ]);
    }
}
