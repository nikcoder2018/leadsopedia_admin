<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class FltrRegion extends Model
{
    protected $connection = "mongodb";
    protected $collection = "fltrRegion";
    protected $primaryKey = "_id";
    protected $fillable = ['name'];
}
