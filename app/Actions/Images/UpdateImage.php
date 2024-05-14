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
        $attributeNames = array(
            'name' => __('Name'),
            'description' => __('Description'),
            'photo' => __('Image'),
        );

        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255', new SpamFree],
            'description' => ['nullable', 'string', new SpamFree],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png,svg', 'max:4096', 'dimensions:min_width=675,min_height=675'],
        ],[
            'photo.dimensions' => __('Image dimensions must be at least 1280x720(HD)px'),
        ]);

        $validator->setAttributeNames($attributeNames)->validateWithBag('updateImageInformation');

        if (isset($input['photo'])) {
            $image->updatePhoto($input['photo']);
        }

        $image->forceFill([
            'name' => $input['name'],
            'slug' => str($input['name'])->slug() . '-' . str()->random(5),
            'description' => $input['description'],
        ])->save();

        session()->flash('flash.banner', __('Image has been updated.'));
    }
}
