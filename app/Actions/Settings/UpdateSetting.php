<?php

namespace App\Actions\Settings;

use App\Models\Setting;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\UpdatesSettings;
use Illuminate\Validation\Rule;


class UpdateSetting implements UpdatesSettings
{
    /**
     * Validate and update given setting.
     *
     * @param  \App\Models\Setting  $setting
     * @param  array<string, string>  $input
     */
    public function update(Setting $setting, array $input): void
    {
        $attributeNames = array(
            'name' => __('Name'),
            'description' => __('Description'),
        );

        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255', new SpamFree, Rule::unique('settings')->ignore($setting->id)],
            'description' => ['nullable', 'string', new SpamFree],
            'attributes' => ['nullable', 'array'],
        ]);

        $validator->setAttributeNames($attributeNames)->validate();

        if (isset($input['name'])) {
            $setting->forceFill([
                'name' => $input['name'],
                'slug' => str($input['name'])->slug(),
            ]);
        }
        if (isset($input['description'])) {
            $setting->forceFill([
                'description' => $input['description'],
            ]);
        }

        $setting->forceFill([
            'attributes' => $input['attributes'],
        ])->save();

        cache()->forget('settings');

        session()->flash('flash.banner', __('Setting has been updated.'));
    }
}
