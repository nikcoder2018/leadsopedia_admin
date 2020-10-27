<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class TimeZone extends Model
{
    protected $connection = "mongodb";
    protected $collection = "timezones";
}
