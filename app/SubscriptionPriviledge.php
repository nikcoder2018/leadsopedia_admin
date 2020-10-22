<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPriviledge extends Model
{
    protected $connection = "mysql";
    protected $table = "subscription_priviledges";
    protected $fillable = ['subplan_id', 'description', 'enabled'];

    function subscription(){
        return $this->hasOne(Subscription::class, 'id', 'subplan_id');
    }
}
