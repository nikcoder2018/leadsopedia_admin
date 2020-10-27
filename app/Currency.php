<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Currency extends Model
{
    protected $connection = "mongodb";
    protected $collection = "currencies";
}
