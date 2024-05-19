<?php

namespace App\Models;

use App\Filters\UserFilters;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\Agent;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Stevebauman\Location\Facades\Location;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use RecordsActivity;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'country',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
        'last_seen_diff_for_humans',
        'has_sessions',
        'joined_on',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_seen' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        foreach (static::deleteItems() as $item) {
            static::deleting(function ($user) use ($item) {
                $i = $item;
                $user->$i->each->delete();
            });
        }

    }

    protected static function deleteItems(): array
    {
        return ['activities', 'logins', 'galleries', 'images', 'properties'];
    }

    protected function defaultProfilePhotoUrl(): string
    {
        return "https://api.dicebear.com/8.x/avataaars/svg?seed=" . urlencode($this->name) . ""; // icons | pixel-art | ident ...  check https://www.dicebear.com/styles/
    }

    public function logins(): HasMany
    {
        return $this->hasMany(Login::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class)->latest();
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class)->latest();
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class)->latest();
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class)->latest();
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class)->latest();
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->latest();
    }

    public function lastSeenDiffForHumans(): string
    {
/*         if ($this->activities->count() > 0) {
            return $this->activities->first()->created_at->diffForHumans();
        } */
        if ($this->last_seen) {
            return $this->last_seen->diffForHumans();
        }

        return $this->created_at->diffForHumans();
        //return $this->activities->first()->created_at->diffForHumans();
    }

    public function getLastSeenDiffForHumansAttribute(): string
    {
        return $this->lastSeenDiffForHumans();
    }

    public function hasSessions(): bool
    {
        return \DB::table('sessions')->where('user_id', $this->id)->count() > 0 ? true : false;
    }

    public function getHasSessionsAttribute(): bool
    {
        return $this->hasSessions();
    }

    public function joinedOn( ) :string
    {
        return $this->created_at->diffForHumans();
    }

    public function getJoinedOnAttribute() :string
    {
        return $this->joinedOn();
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Filters\UserFilters $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $query, UserFilters $filters): Builder
    {
        return $filters->apply($query);
        /* $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('country', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }) *//* ->when($filters['role'] ?? null, function ($query, $role) {
        $query->whereHas('roles', function ($q) use ($role) {
            $q->where('roles.name', 'like', '%' . $role . '%' ?: '*');
        });
    })->when($filters['status'] ?? null, function ($query, $status) {
        $query->where('status', $status);
    })  ;*/
    }

    /**
     * Create a new agent instance from the given session.
     *
     * @param  mixed  $session
     * @return \Laravel\Jetstream\Agent
     */
    protected function createAgent($session)
    {
        return tap(new Agent(), fn($agent) => $agent->setUserAgent($session));
    }

    public function recordLogin($ip): void
    {

        $ip = (app()->environment() === 'local' && config('location.testing.enabled')) ? config('location.testing.ip') : $ip;
        $agent = $this->createAgent(request()->header('user-agent'));
        //$ip = "84.52.175.124";
        $login = Login::forceCreate([
            'user_id' => $this->id,
            'ip' => $ip,
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

    public static function adminsMailingList() :Collection
    {
        return self::where('is_admin', true)->get();
    }
}
