<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Policies\TranslationPolicy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class TranslationsController extends Controller
{
    /**
     * Display a listing of translations with optional filtering and pagination.
     *
     * @param  Request  $request
     * @return \Inertia\Response
     */
    public function index(Request $request): Response
    {
        $translations = $this->getTranslations();

        $filtered = $this->filterTranslations($translations, $request->get('search'));

        return Inertia::render('Admin/Translations/Index', [
            'filters' => $request->only(['search']),
            'keys_with_translation' => $filtered->paginate(20)->onEachSide(2)->withQueryString(),
            'status' => session('status'),
        ]);
    }

    /**
     * Retrieve all translations from the supported locales.
     *
     * @return Collection
     */
    protected function getTranslations(): Collection
    {
        $translations = [];

        foreach (config('app.supported_locales') as $locale) {
            $path = base_path("lang/{$locale}.json");
            $content = File::exists($path) ? json_decode(File::get($path), true) : [];
            foreach ($content as $key => $value) {
                $translations[$key][$locale] = $value;
            }
        }

        return collect($translations);
    }

    /**
     * Filter translations based on the search term.
     *
     * @param  Collection  $translations
     * @param  string|null  $searchTerm
     * @return Collection
     */
    protected function filterTranslations(Collection $translations, ?string $searchTerm): Collection
    {
        if (!$searchTerm) {
            return $translations;
        }

        return $translations->filter(function (array $translation, string $key) use ($searchTerm) {
            return stripos($key, $searchTerm) !== false ||
                collect($translation)->contains(function ($value) use ($searchTerm) {
                    return stripos($value, $searchTerm) !== false;
                });
        });
    }

    /**
     * Update translations.
     *
     * This function updates or adds new translations for multiple languages based on the provided input.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        Gate::allowIf(fn (User $user) => $user->is_admin);

        // Get new translations from the request
        $newTranslations = $request->get('translations', []);

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
        // Redirect back with a status message
        return back()->with('status', 'Translations updated successfully!');
    }
}
