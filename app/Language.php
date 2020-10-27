<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Language extends Model
{
    protected $connection = "mongodb";
    protected $collection = "languages";
}
