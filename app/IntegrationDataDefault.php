<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntegrationDataDefault extends Model
{
    protected $connection = "mysql";
    protected $table = "integrations_data_default";
    protected $fillable = ['integration_id','name','value','required'];

    public $timestamps = false;
}
