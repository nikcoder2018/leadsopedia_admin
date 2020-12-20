<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Lead extends Model
{
    protected $connection = "mongodb";
    protected $collection = "leads";
    protected $fillable = [
        'name',
        'title',
        'company',
        'industry',
        'email',
        'phone',
        'phone_2',
        'website',
        'street',
        'city',
        'state',
        'region',
        'country', 
        'linkedin',
        'facebook',
        'messenger',
        'instagram',
        'twitter',
    ];

    public function getFillable(){
        return $this->fillable;
    }

    public function isInFillable($value){
        return in_array($value,$this->fillable);
    }
}

