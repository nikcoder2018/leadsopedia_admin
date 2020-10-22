<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $connection = "mysql";
    protected $table = "transactions";

    function customer(){
        return $this->hasOne(Customer::class, 'id', 'user_id');
    }

    function subscription(){
        return $this->hasOne(Subscription::class, 'id', 'subscription_id');
    }

    function method(){
        return $this->hasOne(PaymentMethod::class, 'id', 'payment_method');
    }
}
