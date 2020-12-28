<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class FltrStreet extends Model
{
    protected $connection = "mongodb";
    protected $collection = "fltrStreet";
    protected $primaryKey = "_id";
    protected $fillable = ['name'];
}
