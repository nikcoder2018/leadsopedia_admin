<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = ['code_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function code()
    {
        return $this->belongsTo(ReferralCode::class, 'code_id');
    }
}
