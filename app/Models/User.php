<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Stevebauman\Location\Facades\Location;

class User extends Authenticatable
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
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        foreach (static::deleteItems() as $item) {
            static::deleting(function ($user) use ($item) {
                $i = $item;
                $user->$i->each->delete();
            });
        }

    }

    protected static function deleteItems() {
        return ['activities',];
    }

    protected function defaultProfilePhotoUrl()
    {
        return "https://api.dicebear.com/8.x/rings/svg?seed=" . urlencode($this->name) . ""; // icons | pixel-art | ident ...  check https://www.dicebear.com/styles/
    }

    public function logins()
    {
        return $this->hasMany(Login::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class)->latest();
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('country_code', $search)
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        })->when($filters['role'] ?? null, function ($query, $role) {
            $query->whereHas('roles', function ($q) use ($role) {
                $q->where('roles.name', 'like', '%' . $role . '%' ?: '*');
            });
        })->when($filters['status'] ?? null, function ($query, $status) {
            $query->where('status', $status);
        });
    }

    public function recordLogin($ip)
    {
        $login = Login::forceCreate([
            'user_id' => $this->id,
            'ip' => $ip,
            'location' => Location::get($ip),
        ]);
    }
}
