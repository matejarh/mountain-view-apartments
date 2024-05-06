<?php

namespace App\Actions\Properties;

use App\Contracts\AttachesPropertiesToFacilities;
use App\Contracts\AttachesFacilitiesToProperties;
use App\Models\Property;
use App\Models\Facility;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AttachFacility implements AttachesFacilitiesToProperties
{
    /**
     * Attaches given property to given facility.
     *
     * @param  \App\Models\Property  $property
     * @param  \App\Models\Facility  $facility
     */
    public function attach(Facility $facility, Property $property): void
    {
        $input = [
            'property_id' => $property->id,
            'facility_id' => $facility->id,
        ];

        $attributeNames = array(
            'property_id' => __('Property'),
            'facility_id' => __('Facility'),
        );

        $validator = Validator::make($input, [
            'property_id' => ['required', Rule::unique('properties_facilities')->where(function ($query) use($input) {
                                            return $query->where('property_id', $input['property_id'])
                                                        ->where('facility_id', $input['facility_id']);
                                        })],
            'facility_id' => ['nullable', Rule::unique('properties_facilities')->where(function ($query) use($input) {
                                                return $query->where('property_id', $input['property_id'])
                                                            ->where('facility_id', $input['facility_id']);
                                            })],
                                        ],[
        ]);

        $validator->setAttributeNames($attributeNames)->validateWithBag('attachingToFacility');

        $property->facilities()->attach($facility);

        session()->flash('flash.banner', __('Facility has been attached to the property.'));
    }
}
