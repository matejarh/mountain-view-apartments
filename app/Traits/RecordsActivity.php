<?php

namespace App\Traits;

use App\Models\Activity;
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
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event)
        ]);
    }

    public function getActivityType($event)
    {
        $type = \Str::lower((new \ReflectionClass($this))->getShortName());
        return $event . '_' . $type;
    }

    protected function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}
