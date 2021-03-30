<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Referral;
use App\ReferralCode;
class Customer extends Model
{
    protected $table = "users";
    protected $connection = "mysql";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $dates = ['subscription_starts','subscription_ends'];
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

    public function subscription(){
        return $this->hasOne(Subscription::class, 'id', 'subscription_id');
    }

    public function getDateRegisteredAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function getReferralsAttribute(){
        $refs = ReferralCode::where('user_id', $this->id)->with('referrals')->first();
        return $refs;
    }

    public function getCountReferralsAttribute(){
        $count = 0;
        $refs = ReferralCode::where('user_id', $this->id)->with('referrals')->get();

        if($refs){
            foreach($refs as $ref){
                $count += count($ref->referrals);
            }
        }
        return $count;
    }
}
