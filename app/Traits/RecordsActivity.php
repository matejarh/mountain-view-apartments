<?php

namespace App\Traits;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Laravel\Jetstream\Agent;
use Stevebauman\Location\Facades\Location;

trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        if (auth()->guest()) return;
        foreach (static::getActivitiesToRecord() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }

        static::deleting(function ($model) {
            $model->activity()->delete();
        });

    }

    protected static function getActivitiesToRecord(): array
    {
        return ['created', 'updated', 'deleted'];
    }

    protected function recordActivity($event) :void
    {
        $agent = $this->createAgent(request()->header('user-agent'));

        $ip = (app()->environment() === 'local' && config('location.testing.enabled')) ? config('location.testing.ip') : request()->ip();

        $this->activity()->forceCreate([
            'user_id' => auth()->check() ? auth()->id() : null,
            'type' => $this->getActivityType($event),
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

    protected function createAgent($session): Agent
    {
        return tap(new Agent(), fn($agent) => $agent->setUserAgent($session));
    }

    public function getActivityType($event): string
    {
        $type = str((new \ReflectionClass($this))->getShortName())->lower();
        return $event . '_' . $type;
    }

    protected function activity(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}
