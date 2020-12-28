<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class FltrCountry extends Model
{
    protected $connection = "mongodb";
    protected $collection = "fltrCountry";
    protected $primaryKey = "_id";
    protected $fillable = ['name'];
}
