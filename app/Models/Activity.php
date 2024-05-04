<?php

namespace App\Models;

use App\Filters\ActivityFilters;
use Illuminate\Broadcasting\EncryptedPrivateChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class Activity extends Model
{
    use BroadcastsEvents;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['subject'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'agent' => 'array',
            'location' => 'object',
            'created_at' => 'datetime',
        ];
    }


    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'created_at_diff_for_humans',
        'created_at_day',
    ];

    /**
     * Get the channels that model events should broadcast on.
     *
     * @return array<string, array<int, \Illuminate\Broadcasting\Channel|\Illuminate\Database\Eloquent\Model>>
     */
    public function broadcastOn($event)
    {
        // return [new EncryptedPrivateChannel('App.Models.Wallet.'.$this->id)];
        //return [$this, $this->user];
        return match ($event) {
            'created' => [new EncryptedPrivateChannel('App.Models.User.' . $this->owner->id)],
            default => [new EncryptedPrivateChannel('App.Models.Activity.' . $this->id)],
        };
    }

    /**
     * The model event's broadcast name.
     */
    public function broadcastAs(string $event): string|null
    {
        return match ($event) {
            'created' => 'activity.created',
            default => null,
        };
    }

    /**
     * Get the data to broadcast for the model.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(string $event): array
    {
        return match ($event) {
            // 'created' => ['title' => $this->title],
            default => ['model' => $this],
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

    /**
     * Filters given query by given filters
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Filters\ActivityFilters $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $query, ActivityFilters $filters): Builder
    {
        return $filters->apply($query);
        /* $query->when($filters['search'] ?? null, function ($query, $search) {
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
        }); */
    }

    /**
     * Returns latest activity feed for given user
     * for given range $skip - $take
     * with subject
     * grouped by days
     *
     * @param \App\Models\User $user
     * @param integer $take
     * @param integer $skip
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function feed(User $user, $take = 50, $skip = 0): Collection
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

    /**
     * Returns latest paginated and filtered activity feed collection for all user
     * with subject
     * with owner
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function adminFeed(Request $request, ActivityFilters $filters): LengthAwarePaginator
    {
        if (auth()->user()->canNot('viewAny', Activity::class))
            abort(403);

        return static::latest()
            ->with('subject', 'owner')
            ->filter($filters)->paginate(12, ['*'], __('page'))->onEachSide(2)->withQueryString()
            /* ->groupBy(function ($activity) use ($locale) {
                return $activity->created_at->locale($locale)->isoFormat('L');
            }) */ ;
    }
}
