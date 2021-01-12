<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $table = 'admin_settings';
    protected $fillable = ['key', 'value'];

    /**
     * @param string $key
     * @return static|null
     */
    public static function get($key)
    {
        return static::where('key', $key)->first();
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return static
     */
    public static function set($key, $value)
    {
        $setting = static::get($key);
        if (!$setting) {
            $setting = new static([
                'key' => $value,
            ]);
        }
        $setting->value = $value;
        $setting->save();
        return $setting;
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function has($key)
    {
        return static::get($key) !== null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
