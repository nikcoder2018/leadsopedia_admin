<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class FltrCity extends Model
{
    protected $connection = "mongodb";
    protected $collection = "fltrCity";
    protected $primaryKey = "_id";
    protected $fillable = ['name'];
}
