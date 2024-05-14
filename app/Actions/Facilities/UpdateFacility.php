<?php

namespace App\Actions\Facilities;

use App\Models\Facility;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\UpdatesFacilities;


class UpdateFacility implements UpdatesFacilities
{
    /**
     * Validate and update given facility.
     *
     * @param  \App\Models\Facility  $facility
     * @param  array<string, string>  $input
     */
    public function update(Facility $facility, array $input): void
    {
        $attributeNames = array(
            'name' => __('Name'),
            'text' => __('Text'),

        );

        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255', new SpamFree, 'unique:facilities,name,except,id'],
            'text' => ['nullable', 'string', 'max:255', new SpamFree],
        ]);

        $validator->setAttributeNames($attributeNames)->validate();

        $facility->forceFill([
            'name' => $input['name'],
            'slug' => str($input['name'])->slug(),
            'text' => isset($input['text']) ? $input['text'] : null,
            'icon' => str($input['name'])->replace('-', ' ')->replace('/', ' ')->title()->replace(' ', '') . 'Icon',
        ])->save();

        session()->flash('flash.banner', __('Facility has been updated.'));
    }
}
