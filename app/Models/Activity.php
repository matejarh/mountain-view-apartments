<?php

namespace App\Models;

use Illuminate\Broadcasting\EncryptedPrivateChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
        'created_at_day',
    ];

    public function broadcastOn($event)
    {
        // return [new EncryptedPrivateChannel('App.Models.Wallet.'.$this->id)];
        //return [$this, $this->user];
        return match ($event) {
            'created' => [new EncryptedPrivateChannel('App.Models.User.' . $this->owner->id)],
            default => [new EncryptedPrivateChannel('App.Models.Activity.' . $this->id)],
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

    public function createdAtDiffForHumans(): string
    {
        return $this->created_at->diffForHumans();
    }


    public function getCreatedAtDiffForHumansAttribute(): string
    {
        $locale = request()->cookie('language') ?: app()->getLocale();
        if ($locale === 'us')
            $locale = 'en';
        return $this->created_at->locale($locale)->diffForHumans();
    }
    public function createdAtDay(): string
    {
        return $this->created_at->locale(app()->currentLocale())->isoFormat('L');
    }

    public function getCreatedAtDayAttribute(): string
    {
        return $this->created_at->locale(app()->currentLocale())->isoFormat('L');
    }

    public function scopeFilter($query, array $filters): void
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            //$query->where(function ($query) use ($search) {
                $query->whereHas('owner', function ($q) use ($search) {
                        $q->where('first_name', 'like', '%' . $search . '%')
                            ->orWhere('name', 'like', '%' . $search . '%')
                            ->orWhere('last_name', 'like', '%' . $search . '%')
                            ->orWhere('phone', 'like', '%' . $search . '%')
                            ->orWhere('country', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    });
            //});
        });
    }

    public static function feed(User $user, $take = 50, $skip = 0)
    {
        $locale = request()->cookie('language') ?: app()->currentLocale();
        if ($locale === 'us')
            $locale = 'en';
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

    public static function adminFeed(Request $request)
    {
        if (auth()->user()->canNot('viewAny', Activity::class)) abort(403);

        return static::latest()
            ->with('subject', 'owner')
            ->filter($request->only(['search']))->paginate(12, ['*'], __('page'))->onEachSide(2)->withQueryString()
            /* ->groupBy(function ($activity) use ($locale) {
                return $activity->created_at->locale($locale)->isoFormat('L');
            }) */ ;
    }
}
