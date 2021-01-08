<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection = "mysql";
    protected $table = "admin";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            if ($user->avatar === '') {
                $user->avatar = 'public/users-avatar/avatar.png';
            }

            collect([
                [
                    'key' => 'theme',
                    'value' => 'vuexy',
                ],
                [
                    'key' => 'collapsible-mode',
                    'value' => 'off',
                ],
                [
                    'key' => 'theme-mode',
                    'value' => 'dark',
                ],
                [
                    'key' => 'layout-mode',
                    'value' => 'full',
                ],
                [
                    'key' => 'navbar-color',
                    'value' => 'bg-white',
                ],
                [
                    'key' => 'nav-layout',
                    'value' => 'floating',
                ],
                [
                    'key' => 'footer-layout',
                    'value' => 'static',
                ],
            ])->each(function ($entry) use ($user) {
                $user->setSetting($entry['key'], $entry['value']);
            });
        });
    }

    public function getSetting($key, $default = null)
    {
        $setting = $this->settings()->where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public function setSetting($key, $value)
    {
        $setting = $this->settings()->where('key', $key)->first();
        if (!$setting) {
            $setting = $this->settings()->make(['key' => $key]);
        }
        $setting->value = $value;
        $setting->save();
        return $setting;
    }

    public function settings()
    {
        return $this->hasMany(UserSetting::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
