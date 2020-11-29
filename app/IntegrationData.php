<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntegrationData extends Model
{
    protected $connection = "mysql";
    protected $table = "integrations_data";
    protected $fillable = ['integration_id','user_id','name','value','required'];

    public $timestamps = false;
}
