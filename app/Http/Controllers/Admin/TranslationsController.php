<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;
use Inertia\Response;

class TranslationsController extends Controller
{
    public function index(Request $request): Response
    {
        $translations = [];

        foreach (config('app.supported_locales') as $locale) {
            $path = base_path("lang/{$locale}.json");
            $content = File::exists($path) ? json_decode(File::get($path), true) : [];
            foreach ($content as $key => $value) {
                $translations[$key][$locale] = $value;
            }
        }

        $filtered = collect($translations);

        if ($request->has('search')) {
            $searchTerm = $request->get('search');
            $filtered = $filtered->filter(function (array $translation, $key) use ($searchTerm) {
                return stripos($key, $searchTerm) !== false ||
                    collect($translation)->contains(function ($value) use ($searchTerm) {
                        return stripos($value, $searchTerm) !== false;
                    });
            });
        } else {
            $filtered = collect($translations);
        }

        /* if ($searchTerm) {
            $translations = $filtered->filter(function ($translation, $key) use ($searchTerm) {
                // Check if the key or any value matches the search term
                return stripos($key, $searchTerm) !== false ||
                       collect($translation)->contains(function ($value) use ($searchTerm) {
                           return stripos($value, $searchTerm) !== false;
                       });
            });
        } */

        // dd($translations);
        return Inertia::render('Admin/Translations/Index', [
            'filters' => $request->only(['search']),
            'keys_with_translation' => $filtered->paginate(20, null, null, __('page'))->onEachSide(2)->withQueryString(),
            //'locales' => config('app.supported_locales'),
            'status' => session('status'),
        ]);
    }

    public function update(Request $request)
    {
        $newTranslations = $request->get('translations');

        foreach ($newTranslations as $key => $translations) {
            foreach ($translations as $lang => $translation) {
                $path = base_path("lang");
                $filePath = "{$path}/{$lang}.json";

                if (!file_exists($path)) mkdir($path, 755, true);
                // Read existing translations
                $existingTranslations = [];
                if (File::exists($filePath)) {
                    $existingTranslations = json_decode(File::get($filePath), true);
                }

                // Update or add the translation
                $existingTranslations[$key] = $translation;

                // Save the updated translations
                File::put($filePath, json_encode($existingTranslations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }
        }

        return back()->with('status', 'Translations updated successfully!');
    }
}
