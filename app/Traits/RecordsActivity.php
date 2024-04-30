<?php

namespace App\Traits;

use App\Models\Activity;
use Laravel\Jetstream\Agent;
use Stevebauman\Location\Facades\Location;
use Str;

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

    protected static function getActivitiesToRecord()
    {
        return ['created', 'updated'];
    }

    protected function recordActivity($event)
    {
        $agent = $this->createAgent(request()->header('user-agent'));
        $ip=request()->ip();
        //$ip = "84.52.175.124";
        $this->activity()->create([
            'user_id' => auth()->id(),
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

    protected function createAgent($session)
    {
        return tap(new Agent(), fn($agent) => $agent->setUserAgent($session));
    }

    public function getActivityType($event)
    {
        $type = str((new \ReflectionClass($this))->getShortName())->lower();
        return $event . '_' . $type;
    }

    protected function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}
