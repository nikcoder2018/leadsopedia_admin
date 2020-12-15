<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class ResultData extends Model
{
    protected $connection = "mongodb";
    protected $collection = "results_data";

    protected $fillable = ['result_id','lead_id'];
}
