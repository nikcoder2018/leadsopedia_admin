<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class FltrTitle extends Model
{
    protected $connection = "mongodb";
    protected $collection = "fltrTitles";
    protected $primaryKey = "_id";
    protected $fillable = ['name'];
}
