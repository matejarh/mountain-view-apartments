<?php

namespace App\Actions\Images;

use App\Models\Image;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\CreatesNewImages;


class CreateNewImage implements CreatesNewImages
{
    /**
     * Validate and create new image.
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
            'photo' => ['nullable', 'mimes:jpg,jpeg,png,svg', 'max:2048'],
        ]);

        $validator->setAttributeNames($attributeNames)->validateWithBag('creatingImageBag');

        $image = Image::forceCreate([
            'user_id' => auth()->id(),
            'name' => $input['name'],
            'slug' => str($input['name'])->slug(),
            'description' => isset($input['description']) ? $input['description'] : null,
        ]);

        if (isset($input['photo'])) {
            $image->updatePhoto($input['photo']);
        }
    }
}
