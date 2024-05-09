<?php

namespace App\Actions\Properties;

use App\Contracts\AttachesGalleriesToProperties;
use App\Models\Property;
use App\Models\Gallery;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AttachGallery implements AttachesGalleriesToProperties
{
    /**
     * Attaches given property to given gallery.
     *
     * @param  \App\Models\Property  $property
     * @param  \App\Models\Gallery  $gallery
     */
    public function attach(Gallery $gallery, Property $property): void
    {
        // dd($property);
        $input = [
            'property_id' => $property->id,
            'gallery_id' => $gallery->id,
        ];

        $attributeNames = array(
            'property_id' => __('Property'),
            'gallery_id' => __('Gallery'),
        );

        $validator = Validator::make($input, [
            'property_id' => ['required', Rule::unique('properties_galleries')->where(function ($query) use($input) {
                                            return $query->where('property_id', $input['property_id'])
                                                        ->where('gallery_id', $input['gallery_id']);
                                        })],
            'gallery_id' => ['required', Rule::unique('properties_galleries')->where(function ($query) use($input) {
                                                return $query->where('property_id', $input['property_id'])
                                                            ->where('gallery_id', $input['gallery_id']);
                                            })],
                                        ],[
        ]);

        $validator->setAttributeNames($attributeNames)->validateWithBag('attachingToGallery');

        $property->galleries()->attach($gallery);

        session()->flash('flash.banner', __('Gallery has been attached to the property.'));
    }
}
