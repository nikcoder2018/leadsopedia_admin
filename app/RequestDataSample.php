<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestDataSample extends Model
{
    protected $connection = "mysql";
    protected $table = "request_data_samples";

    protected $fillable = ['request_data_id', 'data'];
}
