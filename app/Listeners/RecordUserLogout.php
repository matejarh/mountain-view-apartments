<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Jetstream\Agent;
use Stevebauman\Location\Facades\Location;

class RecordUserLogout
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $agent = $this->createAgent(request()->header('user-agent'));

        \Log::debug('event', [request()->ip()]);

        $ip = (app()->environment() === 'local' && config('location.testing.enabled')) ? config('location.testing.ip') : request()->ip();

        $event->user->activities()->create([

                'user_id' => auth()->id(),
                'type' => 'created_logout',
                'subject_id' => auth()->id(),
                'subject_type' => 'App\\Models\\User',
                'agent' => [
                    'is_desktop' => $agent->isDesktop(),
                    'is_tablet' => $agent->isTablet(),
                    'is_mobile' => $agent->isMobile(),
                    'platform' => $agent->platform(),
                    'browser' => $agent->browser(),
                ],
                'location' => cache()->rememberForever('location-' . $ip, function () use ($ip) {
                    return Location::get($ip);
                }),

        ]);

    }

    protected function createAgent($session)
    {
        return tap(new Agent(), fn($agent) => $agent->setUserAgent($session));
    }
}
