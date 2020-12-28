<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class FltrState extends Model
{
    protected $connection = "mongodb";
    protected $collection = "fltrState";
    protected $primaryKey = "_id";
    protected $fillable = ['name'];
}
