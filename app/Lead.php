<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Lead extends Model
{
    protected $connection = "mongodb";
    protected $collection = "leads";
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'title',
        'company_name',
        'industry',
        'email',
        'phone',
        'website',
        'street',
        'city',
        'state',
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

