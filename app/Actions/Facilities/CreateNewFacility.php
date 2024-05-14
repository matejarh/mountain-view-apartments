<?php

namespace App\Actions\Facilities;

use App\Models\Facility;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\CreatesNewFacilities;


class CreateNewFacility implements CreatesNewFacilities
{
    /**
     * Validate and create new facility.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input)
    {
        $attributeNames = array(
            'name' => __('Name'),
            'text' => __('Text'),

        );

        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255', new SpamFree, 'unique:facilities'],
            'text' => ['nullable', 'string', 'max:255', new SpamFree],
        ]);

        $validator->setAttributeNames($attributeNames)->validate();

        Facility::forceCreate([
            'name' => $input['name'],
            'slug' => str($input['name'])->slug(),
            'text' => isset($input['text']) ? $input['text'] : null,
            'icon' => str($input['name'])->replace('-', ' ')->replace('/', ' ')->title()->replace(' ', '') . 'Icon',
        ]);

        session()->flash('flash.banner', __('Facility has been created.'));
    }
}
