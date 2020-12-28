<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class FltrTitleGroup extends Model
{
    protected $connection = "mongodb";
    protected $collection = "fltrTitlesGroup";
    protected $primaryKey = "_id";
    protected $fillable = ['name', 'titles'];
}
