<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class FltrIndustryCategory extends Model
{
    protected $connection = "mongodb";
    protected $collection = "fltrIndustryCategory";
    protected $primaryKey = "_id";
    protected $fillable = ['name'];
}
