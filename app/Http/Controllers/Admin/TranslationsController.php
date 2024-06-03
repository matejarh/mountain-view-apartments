<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\TranslationsUpdateResponse;
use App\Contracts\UpdatesTranslations;
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
    public function update(Request $request, UpdatesTranslations $updater): TranslationsUpdateResponse
    {
        Gate::allowIf(fn (User $user) => $user->is_admin);

        $updater->update($request->all());

        return app(TranslationsUpdateResponse::class);
    }
}
