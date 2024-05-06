<?php

namespace App\Actions\Settings;

use App\Models\Setting;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\CreatesNewSettings;


class CreateNewSetting implements CreatesNewSettings
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
            'name' => ['required', 'string', 'max:255', new SpamFree, 'unique:settings'],
            'description' => ['nullable', 'string', new SpamFree],
            'attributes' => ['nullable', 'array'],
        ]);

        $validator->setAttributeNames($attributeNames)->validateWithBag('creatingNewSetting');

        Setting::forceCreate([
            'name' => str($input['name'])->title(),
            'slug' => str($input['name'])->slug(),
            'description' => isset($input['description']) ? $input['description'] : null,
            'attributes' => isset($input['attributes']) ? $input['attributes'] : "{}",
        ]);

        cache()->forget('settings');

        session()->flash('flash.banner', __('New setting has been created.'));
    }
}
