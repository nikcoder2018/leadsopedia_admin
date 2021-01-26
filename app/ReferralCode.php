<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ReferralCode extends Model
{
    protected $fillable = ['code', 'user_id'];

    protected static function booted()
    {
        static::creating(function (self $referralCode) {
            $referralCode->code = Str::random(8);
        });
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class, 'code_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
