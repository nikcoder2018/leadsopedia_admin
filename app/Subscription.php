<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $connection = "mysql";
    protected $table = "subscription_plans";
    protected $fillable = ['title','description','months','days','price','price_annual','search_limits','search_leads_limits','credits','css_class', 'css_btn_class', 'is_trial'];

    function priviledges(){
        return $this->hasMany(SubscriptionPriviledge::class, 'subplan_id', 'id');
    }
}
