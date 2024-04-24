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

    public static function feed(User $user, $take = 50)
    {
        return static::where('user_id', $user->id)
            ->latest()
            ->with('subject')
            ->take($take)
            ->get()
            ->groupBy(function ($activity) {
                return $activity->created_at->format('d. m. Y');
            });
    }
}
