<?php

namespace App\Actions\Translations;

use App\Rules\SpamFree;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Contracts\UpdatesTranslations;
use Illuminate\Validation\Rule;


class UpdateTranslations implements UpdatesTranslations
{
    /**
     * Validate and update translations.
     *
     * @param  array<string, string>  $input
     */
    public function update(array $input): void
    {
        $newTranslations = (array) $input['translations'];

        // Iterate over the new translations
        foreach ($newTranslations as $key => $translations) {
            foreach ($translations as $locale => $translation) {
                $path = base_path("lang/{$locale}.json");

                // Ensure the language directory exists
                if (!File::exists(dirname($path))) {
                    File::makeDirectory(dirname($path), 0755, true);
                }

                // Read existing translations
                $existingTranslations = File::exists($path) ? json_decode(File::get($path), true) : [];

                // Update or add the translation
                $existingTranslations[$key] = $translation;

                // Save the updated translations
                File::put($path, json_encode($existingTranslations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }
        }

        session()->flash('flash.banner', __('Translations updated successfully!'));
    }
}
