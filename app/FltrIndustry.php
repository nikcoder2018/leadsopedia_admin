<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class FltrIndustry extends Model
{
    protected $connection = "mongodb";
    protected $collection = "fltrIndustry";
    protected $primaryKey = "_id";
    protected $fillable = ['name'];
}
