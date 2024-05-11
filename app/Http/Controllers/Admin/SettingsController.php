<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CreatesNewSettings;
use App\Contracts\SettingCreateResponse;
use App\Contracts\SettingUpdateResponse;
use App\Contracts\UpdatesSettings;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class SettingsController extends Controller
{
    public function index(Request $request): Response
    {
        Gate::authorize('viewAny', Setting::class);

        return Inertia::render('Admin/Settings/Show', [
            'settings' => Setting::all(),
            //'settings' => Inertia::lazy(fn () => Setting::all()),
        ]);
    }


    /**
     * Creates new setting with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\CreatesNewSettings  $creator
     * @return \App\Contracts\SettingCreateResponse
     */
    public function store(Request $request, CreatesNewSettings $creator): SettingCreateResponse
    {
        // Authorize the user to create a new setting
        Gate::authorize('create', Setting::class);

        // Create a new setting using the specified creator service
        $creator->create($request->all());

        // Return a response indicating successful creation of the setting
        return app(SettingCreateResponse::class);
    }

    /**
     * Updates given setting with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @param  \App\Contracts\UpdatesSettings  $updater
     * @return \App\Contracts\SettingUpdateResponse
     */
    public function update(Request $request, Setting $setting, UpdatesSettings $updater): SettingUpdateResponse
    {
        Gate::authorize('update', $setting);

        $updater->update($setting, $request->all());

        return app(SettingUpdateResponse::class);
    }
}
