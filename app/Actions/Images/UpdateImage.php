<?php

namespace App\Actions\Images;

use App\Models\Image;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\UpdatesImages;


class UpdateImage implements UpdatesImages
{
    /**
     * Validate and update given image.
     *
     * @param  \App\Models\Image  $image
     * @param  array<string, string>  $input
     */
    public function update(Image $image, array $input): void
    {
        \Log::debug('update-image', $input);

        $attributeNames = array(
            'name' => __('Name'),
            'description' => __('Description'),
        );

        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255', new SpamFree],
            'description' => ['nullable', 'string', new SpamFree],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png,svg', 'max:2048'],
        ]);

        $validator->setAttributeNames($attributeNames)->validateWithBag('updateImageInformation');

        if (isset($input['photo'])) {
            $image->updatePhoto($input['photo']);
        }

        $image->forceFill([
            'name' => $input['name'],
            'description' => $input['description'],
        ])->save();
    }
}
