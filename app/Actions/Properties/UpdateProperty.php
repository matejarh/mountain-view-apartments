<?php

namespace App\Actions\Properties;

use App\Models\Property;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\UpdatesProperties;


class UpdateProperty implements UpdatesProperties
{
    /**
     * Validate and update given property.
     *
     * @param  \App\Models\Property  $property
     * @param  array<string, string>  $input
     */
    public function update(Property $property, array $input): void
    {
        $attributeNames = array(
            'name' => __('Name'),
            'description' => __('Description'),
            'type' => __('Type'),
            'address' => __('Address'),
            'keywords' => __('Keywords'),
            'is_entire_apartment' => __('Iis Entire Apartment'),
            'bed_types' => __('Bed Types'),
            'facilities' => __('Facilities'),
            'recomended' => __('Recomended'),
            'prices' => __('Prices'),
            'prices.*.guests' => __('Number of guests'),
            'prices.*.price' => __('Price'),
            'rules' => __('Rules'),
            'coordinates.lng' => __('Longitude'),
            'coordinates.lat' => __('Latitude'),
        );

        $validator = Validator::make($input, [
            'type' => ['required', 'string', 'max:255', new SpamFree] ,
            'name' => ['required', 'string', 'max:255', new SpamFree],
            'description' => ['nullable', 'string', new SpamFree],
            'address' => ['required', 'string', 'max:255', new SpamFree] ,
            'keywords' => ['nullable', 'string', new SpamFree] ,
            'is_entire_apartment' => ['required', 'boolean'],
            'coordinates' => ['required', 'array', 'min:2', 'max:2'],
            'coordinates.*' => ['required', 'numeric'],
            'bed_types' => ['required', 'array', 'min:1'],
            'bed_types.*' => ['required', 'array', 'distinct', 'min:1'],
            'bed_types.*.name' => ['required', 'string', new SpamFree],
            'bed_types.*.title' => ['required', 'string', new SpamFree],
            'recomended' => ['required', 'array', 'min:1'],
            'recomended.*' => ['required', 'string', 'distinct', new SpamFree],
            'prices' => ['required', 'array', 'min:1'],
            'prices.*' => ['required', 'array', 'distinct', 'min:2', 'max:2'],
            'prices.*.guests' => ['required', 'integer', 'min:1', 'max:30'],
            'prices.*.price' => ['required', 'string', new SpamFree],
            'rules' => ['required', 'array', 'min:1'],
            'rules.*' => ['required', 'array', 'distinct', 'min:1'],
            'rules.*.title' => ['nullable', 'string', new SpamFree],
            'rules.*.name' => ['required', 'string', new SpamFree],
            'rules.*.description' => ['nullable', 'string', new SpamFree],
            'rules.*.icon' => ['required', 'string', new SpamFree],
        ]);

        $validator->setAttributeNames($attributeNames)->validateWithBag('updatingProperty');

        $property->forceFill([
            'name' => $input['name'],
            'type' => $input['type'],
            'slug' => str($input['name'])->slug(),
            'description' => isset($input['description']) ? $input['description'] : null,
            'address' => isset($input['address']) ? $input['address'] : null,
            'keywords' => isset($input['keywords']) ? $input['keywords'] : null,
            'is_entire_apartment' => $input['is_entire_apartment'],
            'coordinates' => isset($input['coordinates']) ? $input['coordinates'] : null,
            'bed_types' => isset($input['bed_types']) ? $input['bed_types'] : null,
            'recomended' => isset($input['recomended']) ? $input['recomended'] : null,
            'prices' => isset($input['prices']) ? $input['prices'] : null,
            'rules' => isset($input['rules']) ? $input['rules'] : null,
        ])->save();

        session()->flash('flash.banner', __('Property has been updated.'));
    }
}
