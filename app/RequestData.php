<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestData extends Model
{
    protected $connection = "mysql";
    protected $table = "request_data";

    public function samples(){
        return $this->hasMany(RequestDataSample::class, 'request_data_id', 'id');
    }
}
