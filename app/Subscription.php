<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $connection = "mysql";
    protected $table = "subscription_plans";
    protected $fillable = ['title','description','months','price','css_class', 'css_btn_class'];

    function priviledges(){
        return $this->hasMany(SubscriptionPriviledge::class, 'subplan_id', 'id');
    }
}
