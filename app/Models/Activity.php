<?php

namespace App\Models;

use Illuminate\Broadcasting\EncryptedPrivateChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use BroadcastsEvents;

    protected $guarded = [];

    protected $with = ['subject'];

    protected $casts = [
        'agent' => 'array',
        'location' => 'object',
        'created_at' => 'datetime',
    ];

    protected $appends = [
        'created_at_diff_for_humans',
    ];

    public function broadcastOn($event)
    {
        // return [new EncryptedPrivateChannel('App.Models.Wallet.'.$this->id)];
        //return [$this, $this->user];
        return match ($event) {
            'created' => [new EncryptedPrivateChannel('App.Models.User.' . $this->owner->id)],
            default => [new EncryptedPrivateChannel('App.Models.Activity.'.$this->id)],
        };
    }

    public function subject()
    {
        return $this->morphTo();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function createdAtDiffForHumans() : string {
        return $this->created_at->diffForHumans();
    }

    public function getCreatedAtDiffForHumansAttribute() : string {
        $locale = request()->cookie('language') ?: app()->getLocale();
        if ($locale === 'us') $locale = 'en';
        return $this->created_at->locale($locale)->toTimeString();
    }

    public static function feed(User $user, $take = 50, $skip = 0)
    {
        $locale = request()->cookie('language') ?: app()->getLocale();
        if ($locale === 'us') $locale = 'en';
        // \Log::debug($locale);
        return static::where('user_id', $user->id)
            ->latest()
            ->with('subject')
            ->take($take)
            ->skip($skip)
            ->get()
            ->groupBy(function ($activity) use ($locale) {
                return $activity->created_at->locale($locale)->isoFormat('L');
            });
    }
}
