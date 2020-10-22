<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $connection = "mysql";
    protected $table = "settings";

    function scopeGetValue($query, $name){
        if($query->where('name',$name)->exists())
            return $query->where('name',$name)->first()->value;
        else 
            return '';
    }

}
